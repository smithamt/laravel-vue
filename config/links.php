<?php

use App\Http\Controllers\Web\EmployeeWebController;
use App\Http\Controllers\Web\NotificationWebController;

return [
    ['view' => 'messages', 'url' => '/about', 'label' => 'About', 'controller' => EmployeeWebController::class],
    ['view' => 'notifications', 'url' => '/notifications', 'label' => 'Notifications', 'controller' => NotificationWebController::class],
    ['view' => 'about', 'url' => '/messages', 'label' => 'Messages', 'controller' => EmployeeWebController::class],
    ['link' => 'employees.index', 'view' => "employees", 'url' => '/employees', 'label' => 'Employees', 'controller' => EmployeeWebController::class],
    ['view' => 'adjustments', 'url' => '/adjustments', 'label' => 'Adjustments', 'controller' => EmployeeWebController::class],
    ['view' => 'planner', 'url' => '/planner', 'label' => 'Planner', 'controller' => EmployeeWebController::class],
    ['view' => 'relations', 'url' => '/relations', 'label' => 'Relations', 'controller' => EmployeeWebController::class],
    ['view' => 'payroll', 'url' => '/payroll', 'label' => 'Payroll', 'controller' => EmployeeWebController::class],
    ['view' => 'app', 'url' => '/app', 'label' => 'App', 'controller' => EmployeeWebController::class],
    ['view' => 'editors', 'url' => '/editors', 'label' => 'Editors', 'controller' => EmployeeWebController::class],
    ['view' => 'trashes', 'url' => '/trashes', 'label' => 'Trashes', 'controller' => EmployeeWebController::class],
];
