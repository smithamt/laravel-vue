@extends('layouts.workspace')

@section('content')
<div class="w-full h-full p-4">
    <div class="cart-bg p-4 rounded-lg">
        <h1>Edit Allowance</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('allowances.update', $allowance->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $allowance->name }}" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nickname" class="form-label">Nickname</label>
                <input type="text" class="form-control" id="nickname" name="nickname" value="{{ $allowance->nickname }}">
                @error('nickname')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="allowanceId" class="form-label">Allowance ID</label>
                <input type="text" class="form-control" id="allowanceId" name="allowanceId" value="{{ $allowance->allowanceId }}" required>
                @error('allowanceId')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $allowance->email }}" required>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $allowance->username }}" required>
                @error('username')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <small>Leave blank to keep the current password</small>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="positionId" class="form-label">Position ID</label>
                <input type="number" class="form-control" id="positionId" name="positionId" value="{{ $allowance->positionId }}">
                @error('positionId')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancel</button>
            <button type="submit" class="btn btn-primary">Update Allowance</button>
        </form>
    </div>
</div>
@endsection