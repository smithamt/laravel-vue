<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoomApiController extends Controller
{
    /**
     * Display a listing of the rooms.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::with(['hostel', 'created_by'])->get();
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
            'hostelId' => 'required|exists:hostels,id',
            'isOccupied' => 'boolean',
        ]);

        $room = new Room($validated);
        $room->created_by_id = $user->id; // Assuming the user is authenticated
        $room->save();

        return response()->json($room, 201);
    }

    /**
     * Display the specified room.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::info('reuqest', ['id' => $id]);
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
            'hostelId' => 'sometimes|uuid|exists:hostels,id',
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
