<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Http\Requests\StoreHostelRequest;
use App\Http\Requests\UpdateHostelRequest;
use Illuminate\Support\Facades\Log;

class HostelApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $hostels = Hostel::with('company', 'created_by', 'rooms')->paginate(10);
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
            'companyId' => $user->companyId,
            'created_by_id' => $user->id,
        ]);

        // Create and save the hostel
        $hostel = Hostel::create($data);
        return response()->json($hostel, 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $hostel = Hostel::with(['created_by' => function ($query) {
            $query->select('id', 'name', 'nickname', 'employee_id');
        }, 'rooms' => function ($query) {
            $query->select('id', 'roomNumber', 'hostelId'); // Ensure to select the foreign key 'hostelId' 
        }])->findOrFail($id);
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
