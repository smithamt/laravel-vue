@extends('layouts.workspace')

@section('content')
<div class="container">
    <h1>Employee Details</h1>
    <div>
        <p><strong>Name:</strong> {{ $employee->name }}</p>
        <p><strong>Nickname:</strong> {{ $employee->nickname }}</p>
        <p><strong>Employee ID:</strong> {{ $employee->employee_id }}</p>
        <p><strong>Email:</strong> {{ $employee->email }}</p>
        <p><strong>Username:</strong> {{ $employee->username }}</p>
        <p><strong>Position ID:</strong> {{ $employee->position_id }}</p>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to List</a>
        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endsection
