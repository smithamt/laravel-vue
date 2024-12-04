<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Department;

class DashboardWebController extends Controller
{
    public function index()
    {
        $employeeCount = Employee::count();
        $positionCount = Position::count();
        $departmentCount = Department::count();
        return view('dashboard', compact('employeeCount', 'positionCount', 'departmentCount'));
    }
}
