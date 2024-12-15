<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\EmployeeRoom;
use App\Models\Room;
use Carbon\Carbon;

class EmployeeRoomApiController extends Controller
{
    /**
     * Display a listing of the EmployeeRooms.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = EmployeeRoom::with(['employee', 'room']);

        if ($request->has('room_id')) {
            $roomId = $request->input('room_id');
            $query->where('room_id', $roomId);
        }

        $employeeRooms = $query->paginate(10);
        return response()->json($employeeRooms, 200);
    }


    /**
     * Store a newly created EmployeeRoom in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'room_id' => 'required|exists:rooms,id',
            'starting_date' => 'required|date',
            'created_by_id' => 'required|exists:employees,id',
        ]);

        $employeeRoom = EmployeeRoom::create($request->all());

        return response()->json(['message' => 'EmployeeRoom created successfully', 'data' => $employeeRoom], 201);
    }

    /**
     * Display the specified EmployeeRoom.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employeeRoom = EmployeeRoom::with(['employee', 'room'])->findOrFail($id);
        return response()->json($employeeRoom, 200);
    }

    /**
     * Update the specified EmployeeRoom in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'room_id' => 'required|exists:rooms,id',
            'starting_date' => 'required|date',
            'created_by_id' => 'required|exists:employees,id',
        ]);

        $employeeRoom = EmployeeRoom::findOrFail($id);
        $employeeRoom->update($request->all());

        return response()->json(['message' => 'EmployeeRoom updated successfully', 'data' => $employeeRoom], 200);
    }

    /**
     * Remove the specified EmployeeRoom from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employeeRoom = EmployeeRoom::findOrFail($id);
        $employeeRoom->delete();

        return response()->json(['message' => 'EmployeeRoom deleted successfully'], 200);
    }

    /**
     * Add multiple employees to a room.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $roomId
     * @return \Illuminate\Http\Response
     */
    public function addEmployees(Request $request, $roomId)
    {
        $request->validate([
            'employee_ids' => 'required|array',
            'employee_ids.*' => 'exists:employees,id',
        ]);

        $employeeIds = $request->input('employee_ids');
        $room = Room::findOrFail($roomId);

        $currentOccupancy = $room->employees()->count();
        $newOccupancy = $currentOccupancy + count($employeeIds);

        if ($newOccupancy > $room->capacity) {
            return response()->json(['error' => 'Room does not have enough capacity'], Response::HTTP_BAD_REQUEST);
        }

        foreach ($employeeIds as $employeeId) {
            EmployeeRoom::updateOrCreate(
                [
                    'employee_id' => $employeeId,
                    'room_id' => $roomId,
                ],
                [
                    'starting_date' => Carbon::now(),
                    'created_by_id' => $request->input('created_by_id'),
                ]
            );
        }

        return response()->json(['message' => 'Employees added or updated in room successfully'], Response::HTTP_OK);
    }
}
