@extends('layouts.app')

@section('content')
<div class="w-full h-full p-4">
    <div class="cart-bg p-4 rounded-lg">
        <h1>Add New Employee</h1>
        <form action="{{ route('employees.store') }}" method="POST" class="w-full h-full">
            @csrf
            <div class="grid lg:grid-cols-2 gap-2">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" required>
                </div>
                <div class="mb-3">
                    <label for="nickname" class="form-label">Nickname</label>
                    <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Enter nickname">
                </div>
                <div class="mb-3">
                    <label for="employeeId" class="form-label">Employee ID</label>
                    <input type="text" class="form-control" id="employeeId" name="employeeId" placeholder="Enter employee ID" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>
                <div class="mb-3">
                    <label for="positionId" class="form-label">Position ID</label>
                    <input type="text" class="form-control" id="positionId" name="positionId" placeholder="Enter position ID">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Employee</button>
        </form>

    </div>
</div>
@endsection