<?php

use App\Http\Controllers\BranchWebController;
use App\Http\Controllers\ContractWebController;
use App\Http\Controllers\DepartmentWebController;
use App\Http\Controllers\EmployeeWebController;
use App\Http\Controllers\OrganizationController;

return [
    ['view' => 'branches', 'url' => 'branches', 'label' => 'Branches', 'controller' => BranchWebController::class],
    ['view' => 'departments', 'url' => 'departments', 'label' => 'Departments', 'controller' => DepartmentWebController::class],
    ['view' => 'contracts', 'url' => 'contracts', 'label' => 'Contracts', 'controller' => ContractWebController::class],
    ['view' => 'positions', 'url' => 'positions', 'label' => 'Positions', 'controller' => OrganizationController::class],
    ['view' => 'schedules', 'url' => 'schedules', 'label' => 'Schedules', 'controller' => EmployeeWebController::class],
    ['view' => 'holidays', 'url' => 'holidays', 'label' => 'Holidays', 'controller' => EmployeeWebController::class],
    ['view' => 'leaves', 'url' => 'leaves', 'label' => 'Leave', 'controller' => EmployeeWebController::class],
    ['view' => 'allowances', 'url' => 'allowances', 'label' => 'Allowances', 'controller' => EmployeeWebController::class],
    ['view' => 'deductions', 'url' => 'deductions', 'label' => 'Deductions', 'controller' => EmployeeWebController::class],
    ['view' => 'assets', 'url' => 'assets', 'label' => 'Assets', 'controller' => EmployeeWebController::class],
    ['view' => 'currencies', 'url' => 'currencies', 'label' => 'Currencies', 'controller' => EmployeeWebController::class],
];
