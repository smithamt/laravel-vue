<?php


namespace App\Http\Controllers\Web;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class EmployeeWebController2 extends Controller
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
            ->orWhere('employee_id', 'LIKE', "%{$query}%")
            ->paginate(10); // Adjust pagination as needed

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'employee_id' => 'required|string|max:255|unique:employees,employee_id',
            'nickname' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'username' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
            'position_id' => 'nullable|string|max:255',
            'department_id' => 'nullable|string|max:255',
            'branch_id' => 'nullable|integer',
            'nationality_id' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric',
            'salary_type' => 'nullable|string',
            'currency_id' => 'nullable|string|max:255',
            'roleId' => 'nullable|integer',
            'gender' => 'nullable|string',
            'marital_status_id' => 'nullable|string|max:255',
            'level_of_education_id' => 'nullable|string|max:255',
            'ethnic_group_id' => 'nullable|string|max:255',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'contact_no' => 'nullable|string|max:255',
            'passport_no' => 'nullable|string|max:255',
            'idCardNo' => 'nullable|string|max:255',
            'emergencyContact' => 'nullable|string|max:255',
            'emergencyCall' => 'nullable|string|max:255',
            'channels' => 'nullable|string|max:255',
            'language_id' => 'nullable|string|max:255',
            'degreeOfVision' => 'nullable|string|max:255',
            'hearingLevel' => 'nullable|string|max:255',
            'current_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
        ]);

        $employee = new Employee();
        $employee->fill($validatedData);

        // Hash the password if it is present
        if ($request->filled('password')) {
            $employee->password = Hash::make($request->password);
        }

        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'username' => 'sometimes|nullable|string|max:255',
            'password' => 'nullable|string|min:8', // No need for 'sometimes' here
            'position_id' => 'nullable|string|max:255',
            'department_id' => 'nullable|string|max:255',
            'branch_id' => 'nullable|integer',
            'nationality_id' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric',
            'salary_type' => 'nullable|string',
            'currency_id' => 'nullable|string|max:255',
            'roleId' => 'nullable|integer',
            'gender' => 'nullable|string',
            'marital_status_id' => 'nullable|string|max:255',
            'level_of_education_id' => 'nullable|string|max:255',
            'ethnic_group_id' => 'nullable|string|max:255',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'contact_no' => 'nullable|string|max:255',
            'passport_no' => 'nullable|string|max:255',
            'idCardNo' => 'nullable|string|max:255',
            'emergencyContact' => 'nullable|string|max:255',
            'emergencyCall' => 'nullable|string|max:255',
            'channels' => 'nullable|string|max:255',
            'language_id' => 'nullable|string|max:255',
            'degreeOfVision' => 'nullable|string|max:255',
            'hearingLevel' => 'nullable|string|max:255',
            'current_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
        ]);

        // Fill the employee model with validated data
        $employee->fill($validatedData);

        // Hash the password only if it is present
        if ($request->filled('password')) {
            $employee->password = Hash::make($request->password);
        }

        // Save the updated employee
        $employee->save();

        // Redirect with a success message
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }
}
