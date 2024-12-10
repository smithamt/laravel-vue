<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        // Search employees by name or employee ID
        $employees = Employee::where('name', 'LIKE', "%{$query}%")
            ->orWhere('employee_id', 'LIKE', "%{$query}%")
            ->select('name', 'nickname', 'employee_id', 'id')
            ->paginate(10); // Adjust pagination as needed

        return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'employee_id' => 'required|string|max:255|unique:employees,employee_id',
            'email' => 'required|string|email|max:255|unique:employees,email',
            'username' => 'required|string|max:255|unique:employees,username',
            'password' => 'required|string|min:8|confirmed',
            'position_id' => 'required|integer',
            'department_id' => 'required|integer',
            'branch_id' => 'required|integer',
            'nationality_id' => 'required|integer',
            'salary' => 'required|numeric',
            'salary_type' => 'required|string',
            'currency_id' => 'required|integer',
            'roleId' => 'required|integer',
            'gender' => 'required|string',
            'marital_status_id' => 'required|integer',
            'level_of_education_id' => 'required|integer',
            'ethnic_group_id' => 'required|integer',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'contact_no' => 'required|string|max:255',
            'passport_no' => 'nullable|string|max:255',
            'idCardNo' => 'nullable|string|max:255',
            'emergencyContact' => 'required|string|max:255',
            'emergencyCall' => 'required|string|max:255',
            'channels' => 'nullable|string|max:255',
            'language_id' => 'required|integer',
            'degreeOfVision' => 'nullable|string|max:255',
            'hearingLevel' => 'nullable|string|max:255',
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
        ]);

        $employee = new Employee();
        $employee->fill($validatedData);
        $employee->password = Hash::make($request->password);
        $employee->save();

        return response()->json($employee, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'nickname' => 'sometimes|nullable|string|max:255',
            'employee_id' => 'sometimes|required|string|max:255|unique:employees,employee_id,' . $id,
            'email' => 'sometimes|required|string|email|max:255|unique:employees,email,' . $id,
            'username' => 'sometimes|required|string|max:255|unique:employees,username,' . $id,
            'password' => 'sometimes|nullable|string|min:8|confirmed',
            'position_id' => 'sometimes|required|integer',
            'department_id' => 'sometimes|required|integer',
            'branch_id' => 'sometimes|required|integer',
            'nationality_id' => 'sometimes|required|integer',
            'salary' => 'sometimes|required|numeric',
            'salary_type' => 'sometimes|required|string',
            'currency_id' => 'sometimes|required|integer',
            'roleId' => 'sometimes|required|integer',
            'gender' => 'sometimes|required|string',
            'marital_status_id' => 'sometimes|required|integer',
            'level_of_education_id' => 'sometimes|required|integer',
            'ethnic_group_id' => 'sometimes|required|integer',
            'height' => 'sometimes|nullable|numeric',
            'weight' => 'sometimes|nullable|numeric',
            'contact_no' => 'sometimes|required|string|max:255',
            'passport_no' => 'sometimes|nullable|string|max:255',
            'idCardNo' => 'sometimes|nullable|string|max:255',
            'emergencyContact' => 'sometimes|required|string|max:255',
            'emergencyCall' => 'sometimes|required|string|max:255',
            'channels' => 'sometimes|nullable|string|max:255',
            'language_id' => 'sometimes|required|integer',
            'degreeOfVision' => 'sometimes|nullable|string|max:255',
            'hearingLevel' => 'sometimes|nullable|string|max:255',
            'current_address' => 'sometimes|required|string|max:255',
            'permanent_address' => 'sometimes|nullable|string|max:255',
        ]);

        $employee->fill($validatedData);

        if ($request->filled('password')) {
            $employee->password = Hash::make($request->password);
        }

        $employee->save();

        return response()->json($employee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
    }
}
