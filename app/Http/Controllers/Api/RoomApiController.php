<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeRoom;
use App\Models\Room;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Container\Attributes\Log;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Validation\ValidationException as ValidationValidationException;

use function Illuminate\Log\log;

class RoomApiController extends Controller
{
    /**
     * Display a listing of the rooms.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Initialize query with basic relationships
        $query = Room::with(['hostel', 'created_by']);

        // Add condition if hostel parameter is present in the request
        if ($request->has('hostel')) {
            $hostel_id = $request->input('hostel');
            $query->where('hostel_id', $hostel_id);
        }

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('roomNumber', 'like', "%$search%");
                // ->orWhere('description', 'like', "%$search%");
            });
        }

        // Add public employee count
        $query->withCount(['employees as employees' => function ($query) {
            $query->where('is_public', true);
        }]);

        // Paginate results
        $rooms = $query->paginate(10);

        // Return JSON response
        return response()->json($rooms, 200);
    }

    /**
     * Store a newly created room in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->attributes->get('user');
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validated = $request->validate([
            'roomNumber' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'hostel_id' => 'required|exists:hostels,id',
            'isOccupied' => 'boolean',
        ]);

        $room = new Room($validated);
        $room->created_by_id = $user->id; // Assuming the user is authenticated
        $room->save();

        return response()->json($room, 201);
    }

    public function importRooms(Request $request)
    {
        $user = $request->attributes->get('user');

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Validate the incoming request data
        $validated = $request->validate([
            'rooms' => 'required|array',
            'rooms.*.roomNumber' => 'required|string|max:255',
            'rooms.*.capacity' => 'required|integer',
            'rooms.*.hostel' => 'required|exists:hostels,id',
            'rooms.*.isOccupied' => 'boolean',
        ]);

        $roomsData = $validated['rooms'];
        $processedRooms = [];

        foreach ($roomsData as $roomData) {
            // Use updateOrCreate to check for existing records and update them or create new ones
            $room = Room::updateOrCreate(
                [
                    'roomNumber' => $roomData['roomNumber'],
                    'hostel_id' => $roomData['hostel']
                ],
                [
                    'capacity' => $roomData['capacity'],
                    'isOccupied' => $roomData['isOccupied'] ?? false,
                    'created_by_id' => $user->id
                ]
            );
            $processedRooms[] = $room;
        }

        return response()->json(['message' => 'Rooms imported successfully', 'rooms' => $processedRooms], Response::HTTP_CREATED);
    }

    public function addEmployee(Request $request, $roomId)
    {
        // Validate the incoming request data
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        $employeeId = $request->input('employee_id');

        // Find the room by ID
        $room = Room::findOrFail($roomId);

        // Check if the room has capacity
        if ($room->employees()->count() >= $room->capacity) {
            return response()->json(['error' => 'Room is at full capacity'], Response::HTTP_BAD_REQUEST);
        }

        // Find the employee by ID
        $employee = EmployeeRoom::findOrFail($employeeId);

        // Add employee to the room
        $employee->room_id = $roomId;
        $employee->starting_date = $request->date;
        $employee->save();

        return response()->json(['message' => 'Employee added to room successfully'], Response::HTTP_OK);
    }

    public function getEmployees(Request $request, $roomId)
    {
        // Find the room by ID
        $room = Room::findOrFail($roomId);
        // Get the employees associated with the room
        $employees = $room->employees()->where('is_public', true)->with(['employee' => function ($query) {
            $query->select('id', 'name', 'employee_id', 'nickname')->with(['profile' => function ($query) {
                $query->select('image_id');
            }]);
        }])->paginate(10);

        return response()->json($employees, 200);
    }

    public function addEmployees(Request $request, $roomId)
    {
        $user = $request->attributes->get('user');

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Validate the incoming request data
        $request->validate([
            'employee_ids' => 'required|array',
            'employee_ids.*' => 'exists:employees,id',
        ]);

        $employeeIds = $request->input('employee_ids');

        // Find the room by ID
        $room = Room::findOrFail($roomId);

        // Check if the room has enough capacity
        $currentOccupancy = $room->publicEmployees()->count();
        $newOccupancy = $currentOccupancy + count($employeeIds);

        FacadesLog::error('error', ['total employee' => $currentOccupancy]);

        if ($newOccupancy > $room->capacity) {
            return response()->json(['error' => 'Room does not have enough capacity'], Response::HTTP_BAD_REQUEST);
        }

        // Check if any employee is already in another room with is_public = true
        $alreadyInAnotherRoom = EmployeeRoom::whereIn('id', $employeeIds)
            ->where('is_public', true)
            ->where('room_id', '!=', $roomId)
            ->get(['id', 'room_id']);

        if ($alreadyInAnotherRoom->isNotEmpty()) {
            return response()->json([
                'error' => 'Some employees are already in another room.',
                'details' => $alreadyInAnotherRoom
            ], Response::HTTP_CONFLICT);
        }

        // Add or update employees in the room
        foreach ($employeeIds as $employeeId) {
            EmployeeRoom::updateOrCreate(
                [
                    'id' => $employeeId,
                ],
                [
                    'room_id' => $room->id,
                    'starting_date' => Carbon::now(),
                    'created_by_id' => $user->id,
                    'is_public' => true
                ]
            );
        }

        $updatedEmployees = EmployeeRoom::where('room_id', $roomId)
            ->whereIn('id', $employeeIds)
            ->with('employee:id,name,nickname,employee_id')
            ->get(['id', 'room_id', 'starting_date']);

        return response()->json($updatedEmployees);
    }

    public function importEmployees(Request $request)
    {
        $user = $request->attributes->get('user');

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        try { // Validate the incoming request data
            $validated = $request->validate([
                'room-employees' => 'required|array',
                'room-employees.*.employee' => 'required|exists:employees,employee_id',
                'room-employees.*.roomNumber' => 'required|string|exists:rooms,roomNumber',
                'room-employees.*.is_public' => 'boolean',
            ]);

            $employeesData = $validated['room-employees'];
            $processedEmployees = [];

            foreach ($employeesData as $employeeData) {
                $employeeId = $employeeData['employee'];
                $roomNumber = $employeeData['roomNumber'];
                $isPublic = $employeeData['is_public'] ?? true;

                // Find the employee by employee_id
                $employee = Employee::where('employee_id', $employeeId)->firstOrFail();

                // Find the room by roomNumber
                $room = Room::where('roomNumber', $roomNumber)->firstOrFail();

                // Add or update employees in the room
                $employeeRoom = EmployeeRoom::updateOrCreate(
                    [
                        'id' => $employee->id,
                    ],
                    [
                        'room_id' => $room->id,
                        'starting_date' => Carbon::now(),
                        'created_by_id' => $user->id,
                        'is_public' => $isPublic
                    ]
                );

                $processedEmployees[] = $employeeRoom;
            }

            return response()->json(['message' => 'Employees imported successfully', 'employees' => $processedEmployees], Response::HTTP_CREATED);
        } catch (ValidationValidationException $e) {
            // Collect invalid data
            $invalidData = [];
            foreach ($e->validator->failed() as $key => $value) {
                // Extract the index from the key
                preg_match('/room-employees\.(\d+)\./', $key, $matches);
                if (isset($matches[1])) {
                    $index = $matches[1];
                    $invalidData[] = $request->input('room-employees')[$index];
                }
            }

            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
                'invalid_data' => $invalidData
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }


    public function removeEmployee(Request $request, $employeeRoomId)
    {
        $user = $request->attributes->get('user');

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Find the room by ID

        // Check if the employee is associated with the room
        $employeeRoom = EmployeeRoom::findOrFail($employeeRoomId);

        if (!$employeeRoom) {
            return response()->json(['error' => 'Employee not found in this room'], Response::HTTP_NOT_FOUND);
        }

        // Remove the employee from the room
        $employeeRoom->is_public = false;
        $employeeRoom->save();

        return response()->json(['message' => 'Employee removed from room successfully'], Response::HTTP_OK);
    }

    /**
     * Display the specified room.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::with(['hostel', 'created_by'])->findOrFail($id);
        return response()->json($room, 200);
    }

    /**
     * Update the specified room in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'roomNumber' => 'sometimes|string|max:255',
            'capacity' => 'sometimes|integer',
            'hostel_id' => 'sometimes|uuid|exists:hostels,id',
            'isOccupied' => 'sometimes|boolean',
        ]);

        $room = Room::findOrFail($id);
        $room->update($validated);

        return response()->json($room, 200);
    }

    /**
     * Remove the specified room from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return response()->json(null, 204);
    }
}
