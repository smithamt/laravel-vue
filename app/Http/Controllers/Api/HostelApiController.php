<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Http\Requests\StoreHostelRequest;
use App\Http\Requests\UpdateHostelRequest;
use App\Models\EmployeeRoom;
use Illuminate\Http\Request;

class HostelApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $hostels = Hostel::with([
            'company',
            'created_by',
            'rooms' => function ($query) {
                $query->withCount('employees as employees_count'); // Add the count of employees in each room
            }
        ])->paginate(10);

        // Calculate total employee count for each hostel
        foreach ($hostels as $hostel) {
            $totalEmployees = $hostel->rooms->sum('employees_count');
            $hostel->employees = $totalEmployees;
        }

        return response()->json($hostels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHostelRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreHostelRequest $request)
    {
        $user = $request->attributes->get('user');

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $edit = $request->edit;
        if ($edit) {
            $hostel = Hostel::findOrFail($edit);
            $hostel->update($request->validated());
            return response()->json($hostel);
        }

        // Merge the validated request data with additional fields
        $data = array_merge($request->validated(), [
            'company_id' => $user->company_id,
            'created_by_id' => $user->id,
        ]);

        // Create and save the hostel
        $hostel = Hostel::create($data)->with([
            'created_by' => function ($query) {
                $query->select('id', 'name', 'nickname', 'employee_id');
            },
            'rooms' => function ($query) {
                $query->select('id', 'roomNumber', 'hostel_id') // Ensure to select the foreign key 'hostel_id'
                    ->withCount('employees as employees'); // Add the count of employees in each room
            }
        ]);
        return response()->json($hostel, 201);
    }


    public function getEmployees(Request $request, $hostelId)
    {
        // Get the employees associated with the rooms of the hostel
        $employees = EmployeeRoom::whereHas('room', function ($query) use ($hostelId) {
            $query->where('hostel_id', $hostelId);
        })
            ->where('is_public', true)
            ->with(['employee' => function ($query) {
                $query->select('id', 'name')->with(['profile' => function ($query) {
                    $query->select('image_id'); // Add missing semicolon here
                }]);
            }])
            ->paginate(10);

        return response()->json($employees, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($id)
    {
        $hostel = Hostel::with([
            'created_by' => function ($query) {
                $query->select('id', 'name', 'nickname', 'employee_id');
            },
            'rooms' => function ($query) {
                $query->select('id', 'roomNumber', 'hostel_id') // Ensure to select the foreign key 'hostel_id'
                    ->withCount('employees as employees'); // Add the count of employees in each room
            }
        ])->findOrFail($id);

        return response()->json($hostel);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHostelRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateHostelRequest $request, $id)
    {
        $hostel = Hostel::findOrFail($id);
        $hostel->update($request->validated());
        return response()->json($hostel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $hostel = Hostel::findOrFail($id);
        $hostel->delete();
        return response()->json(null, 204);
    }
}
