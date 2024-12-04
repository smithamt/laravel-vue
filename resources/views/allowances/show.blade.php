@extends('layouts.workspace')

@section('content')
<div class="container">
    <h1>Allowance Details</h1>
    <div>
        <p><strong>Name:</strong> {{ $allowance->name }}</p>
        <p><strong>Nickname:</strong> {{ $allowance->nickname }}</p>
        <p><strong>Allowance ID:</strong> {{ $allowance->allowanceId }}</p>
        <p><strong>Email:</strong> {{ $allowance->email }}</p>
        <p><strong>Username:</strong> {{ $allowance->username }}</p>
        <p><strong>Position ID:</strong> {{ $allowance->positionId }}</p>
        <a href="{{ route('allowances.index') }}" class="btn btn-secondary">Back to List</a>
        <a href="{{ route('allowances.edit', $allowance->id) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endsection
