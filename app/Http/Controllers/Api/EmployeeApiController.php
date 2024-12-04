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
        $employees = Employee::paginate(10);
        $query = $request->input('query');

        // Search employees by name or employee ID
        $employees = Employee::where('name', 'LIKE', "%{$query}%")
            ->orWhere('employeeId', 'LIKE', "%{$query}%")
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
            'employeeId' => 'required|string|max:255|unique:employees,employeeId',
            'email' => 'required|string|email|max:255|unique:employees,email',
            'username' => 'required|string|max:255|unique:employees,username',
            'password' => 'required|string|min:8|confirmed',
            'positionId' => 'required|integer',
            'departmentId' => 'required|integer',
            'branchId' => 'required|integer',
            'nationalityId' => 'required|integer',
            'salary' => 'required|numeric',
            'salaryType' => 'required|string',
            'currencyId' => 'required|integer',
            'roleId' => 'required|integer',
            'gender' => 'required|string',
            'maritalStatusId' => 'required|integer',
            'levelOfEducationId' => 'required|integer',
            'ethnicGroupId' => 'required|integer',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'contactNo' => 'required|string|max:255',
            'passportNo' => 'nullable|string|max:255',
            'idCardNo' => 'nullable|string|max:255',
            'emergencyContact' => 'required|string|max:255',
            'emergencyCall' => 'required|string|max:255',
            'channels' => 'nullable|string|max:255',
            'languageId' => 'required|integer',
            'degreeOfVision' => 'nullable|string|max:255',
            'hearingLevel' => 'nullable|string|max:255',
            'currentAddress' => 'required|string|max:255',
            'permanentAddress' => 'nullable|string|max:255',
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
            'employeeId' => 'sometimes|required|string|max:255|unique:employees,employeeId,' . $id,
            'email' => 'sometimes|required|string|email|max:255|unique:employees,email,' . $id,
            'username' => 'sometimes|required|string|max:255|unique:employees,username,' . $id,
            'password' => 'sometimes|nullable|string|min:8|confirmed',
            'positionId' => 'sometimes|required|integer',
            'departmentId' => 'sometimes|required|integer',
            'branchId' => 'sometimes|required|integer',
            'nationalityId' => 'sometimes|required|integer',
            'salary' => 'sometimes|required|numeric',
            'salaryType' => 'sometimes|required|string',
            'currencyId' => 'sometimes|required|integer',
            'roleId' => 'sometimes|required|integer',
            'gender' => 'sometimes|required|string',
            'maritalStatusId' => 'sometimes|required|integer',
            'levelOfEducationId' => 'sometimes|required|integer',
            'ethnicGroupId' => 'sometimes|required|integer',
            'height' => 'sometimes|nullable|numeric',
            'weight' => 'sometimes|nullable|numeric',
            'contactNo' => 'sometimes|required|string|max:255',
            'passportNo' => 'sometimes|nullable|string|max:255',
            'idCardNo' => 'sometimes|nullable|string|max:255',
            'emergencyContact' => 'sometimes|required|string|max:255',
            'emergencyCall' => 'sometimes|required|string|max:255',
            'channels' => 'sometimes|nullable|string|max:255',
            'languageId' => 'sometimes|required|integer',
            'degreeOfVision' => 'sometimes|nullable|string|max:255',
            'hearingLevel' => 'sometimes|nullable|string|max:255',
            'currentAddress' => 'sometimes|required|string|max:255',
            'permanentAddress' => 'sometimes|nullable|string|max:255',
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
