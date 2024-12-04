<?php

use App\Http\Controllers\EmployeeWebController;
use App\Http\Controllers\NotificationWebController;
use App\Http\Controllers\OrganizationController;

return [
    ['view' => 'organization', 'url' => '/home', 'label' => 'Home', 'controller' => OrganizationController::class],
    ['view' => 'messages', 'url' => '/about', 'label' => 'About', 'controller' => EmployeeWebController::class],
    ['view' => 'notifications', 'url' => '/notifications', 'label' => 'Notifications', 'controller' => NotificationWebController::class],
    ['view' => 'about', 'url' => '/messages', 'label' => 'Messages', 'controller' => EmployeeWebController::class],
    ['view' => 'organization', 'url' => '/organization', 'label' => 'Organization', 'controller' => OrganizationController::class],
    ['link' => 'employees.index', 'view' => "employees", 'url' => '/employees', 'label' => 'Employees', 'controller' => EmployeeWebController::class],
    ['view' => 'adjustments', 'url' => '/adjustments', 'label' => 'Adjustments', 'controller' => EmployeeWebController::class],
    ['view' => 'planner', 'url' => '/planner', 'label' => 'Planner', 'controller' => EmployeeWebController::class],
    ['view' => 'relations', 'url' => '/relations', 'label' => 'Relations', 'controller' => EmployeeWebController::class],
    ['view' => 'payroll', 'url' => '/payroll', 'label' => 'Payroll', 'controller' => EmployeeWebController::class],
    ['view' => 'app', 'url' => '/app', 'label' => 'App', 'controller' => EmployeeWebController::class],
    ['view' => 'editors', 'url' => '/editors', 'label' => 'Editors', 'controller' => EmployeeWebController::class],
    ['view' => 'trashes', 'url' => '/trashes', 'label' => 'Trashes', 'controller' => EmployeeWebController::class],
];
