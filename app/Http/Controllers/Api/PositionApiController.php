<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $positions = Position::with('departments')->get();
        return response()->json($positions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'keyword' => 'nullable|string|max:255',
            'level' => 'nullable|integer',
            'allDepartments' => 'nullable|boolean',
            'isHeadOfDepartment' => 'nullable|boolean',
            'workPeriods' => 'nullable|string|max:255',
            'employeeClassification' => 'nullable|string|max:255',
            'wageInformation' => 'nullable|string|max:255',
            'insuranceType' => 'nullable|string|max:255',
            'budgetCode' => 'nullable|string|max:255',
            'contractType' => 'nullable|string|max:255',
            'compensationRegion' => 'nullable|string|max:255',
            'ref' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'role_id' => 'nullable|exists:roles,id',
            'is_public' => 'nullable|boolean',
            'company_id' => 'required|exists:companies,id',
            'created_by_id' => 'required|exists:employees,id',
        ]);

        $position = Position::create($validatedData);

        return response()->json($position, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $position = Position::findOrFail($id);
        return response()->json($position);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'keyword' => 'nullable|string|max:255',
            'level' => 'nullable|integer',
            'allDepartments' => 'nullable|boolean',
            'isHeadOfDepartment' => 'nullable|boolean',
            'workPeriods' => 'nullable|string|max:255',
            'employeeClassification' => 'nullable|string|max:255',
            'wageInformation' => 'nullable|string|max:255',
            'insuranceType' => 'nullable|string|max:255',
            'budgetCode' => 'nullable|string|max:255',
            'contractType' => 'nullable|string|max:255',
            'compensationRegion' => 'nullable|string|max:255',
            'ref' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'role_id' => 'nullable|exists:roles,id',
            'is_public' => 'nullable|boolean',
            'company_id' => 'sometimes|required|exists:companies,id',
            'created_by_id' => 'sometimes|required|exists:employees,id',
        ]);

        $position = Position::findOrFail($id);
        $position->update($validatedData);

        return response()->json($position);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $position = Position::findOrFail($id);
        $position->delete();

        return response()->json(null, 204);
    }
}
