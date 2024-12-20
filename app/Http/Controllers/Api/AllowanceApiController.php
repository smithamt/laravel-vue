<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Allowance;
use Illuminate\Http\Request;

class AllowanceApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        $allowances = Allowance::when($query, function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
                ->orWhere('keyword', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%");
        })->paginate(10);

        return response()->json($allowances);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAllowanceRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $allowance = Allowance::create($request->validated());
        return response()->json($allowance, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $allowance = Allowance::findOrFail($id);
        return response()->json($allowance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAllowanceRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $allowance = Allowance::findOrFail($id);
        $allowance->update($request->validated());
        return response()->json($allowance);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $allowance = Allowance::findOrFail($id);
        $allowance->isPublic = false;
        $allowance->save();
        return response()->json(null, 204);
    }
}
