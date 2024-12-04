@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Role Details</h1>
    <div>
        <p><strong>Name:</strong> {{ $role->name }}</p>
        <p><strong>Description:</strong> {{ $role->description }}</p>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to List</a>
        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endsection
