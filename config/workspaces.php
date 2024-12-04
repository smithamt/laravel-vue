<?php

use App\Http\Controllers\EmployeeWebController;
use App\Http\Controllers\EmployeeWebController2;
use App\Http\Controllers\OrganizationController;

return [
    ['view' => 'home', 'url' => '/home', 'label' => 'Home', 'controller' => OrganizationController::class],
    ['view' => 'dashboard', 'url' => '/dashboard', 'label' => 'Dashboard', 'controller' => EmployeeWebController::class],
    ['view' => 'employees', 'url' => '/employees', 'label' => 'Employees', 'controller' => EmployeeWebController2::class],
];
