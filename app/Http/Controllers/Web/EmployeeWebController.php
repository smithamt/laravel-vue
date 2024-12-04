<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return view('app.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->nickname = $request->nickname;
        $employee->employeeId = $request->employeeId;
        $employee->email = $request->email;
        $employee->username = $request->username;
        $employee->password = Hash::make($request->password);
        $employee->positionId = $request->positionId;
        $employee->departmentId = $request->departmentId;
        $employee->branchId = $request->branchId;
        $employee->nationalityId = $request->nationalityId;
        $employee->salary = $request->salary;
        $employee->salaryType = $request->salaryType;
        $employee->currencyId = $request->currencyId;
        $employee->roleId = $request->roleId;
        $employee->gender = $request->gender;
        $employee->maritalStatusId = $request->maritalStatusId;
        $employee->levelOfEducationId = $request->levelOfEducationId;
        $employee->ethnicGroupId = $request->ethnicGroupId;
        $employee->height = $request->height;
        $employee->weight = $request->weight;
        $employee->contactNo = $request->contactNo;
        $employee->passportNo = $request->passportNo;
        $employee->idCardNo = $request->idCardNo;
        $employee->emergencyContact = $request->emergencyContact;
        $employee->emergencyCall = $request->emergencyCall;
        $employee->channels = $request->channels;
        $employee->languageId = $request->languageId;
        $employee->degreeOfVision = $request->degreeOfVision;
        $employee->hearingLevel = $request->hearingLevel;
        $employee->currentAddress = $request->currentAddress;
        $employee->permanentAddress = $request->permanentAddress;
        $employee->save();

        return redirect()->route('app.employees.index')->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('app.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('app.employees.edit', compact('employee'));
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

        return redirect()->route('app.employees.index')->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('app.employees.index')->with('success', 'Employee deleted successfully');
    }
}
