@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Role</h1>
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter role name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Enter role description">
        </div>
        <button type="submit" class="btn btn-primary">Add Role</button>
    </form>
</div>
@endsection
