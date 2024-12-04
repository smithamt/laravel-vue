@extends('layouts.workspace')

@section('content')
<div class="container">
    <h1>Allowances</h1>
    <a href="{{ route('allowances.create') }}" class="btn btn-primary mb-3">Add New Allowance</a>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allowances as $allowance)
            <tr>
                <td>{{ $allowance->name }}</td>
                <td>{{ $allowance->email }}</td>
                <td>
                    <a href="{{ route('allowances.show', $allowance->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('allowances.edit', $allowance->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('allowances.destroy', $allowance->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection