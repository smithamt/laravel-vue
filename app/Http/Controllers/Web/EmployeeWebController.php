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
        $employee->employee_id = $request->employee_id;
        $employee->email = $request->email;
        $employee->username = $request->username;
        $employee->password = Hash::make($request->password);
        $employee->position_id = $request->position_id;
        $employee->department_id = $request->department_id;
        $employee->branch_id = $request->branch_id;
        $employee->nationality_id = $request->nationality_id;
        $employee->salary = $request->salary;
        $employee->salary_type = $request->salary_type;
        $employee->currency_id = $request->currency_id;
        $employee->roleId = $request->roleId;
        $employee->gender = $request->gender;
        $employee->marital_status_id = $request->marital_status_id;
        $employee->level_of_education_id = $request->level_of_education_id;
        $employee->ethnic_group_id = $request->ethnic_group_id;
        $employee->height = $request->height;
        $employee->weight = $request->weight;
        $employee->contact_no = $request->contact_no;
        $employee->passport_no = $request->passport_no;
        $employee->idCardNo = $request->idCardNo;
        $employee->emergencyContact = $request->emergencyContact;
        $employee->emergencyCall = $request->emergencyCall;
        $employee->channels = $request->channels;
        $employee->language_id = $request->language_id;
        $employee->degreeOfVision = $request->degreeOfVision;
        $employee->hearingLevel = $request->hearingLevel;
        $employee->current_address = $request->current_address;
        $employee->permanent_address = $request->permanent_address;
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
