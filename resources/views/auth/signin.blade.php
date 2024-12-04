@extends('layouts.auth')

@section('content')
<div class="w-full h-full flex items-center justify-center">
    <div class="container cart-bg rounded-lg w-[450px] p-4 space-y-4">
        <h1 class="text-center font-bold mb-4">Login In to your account</h1>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @else
        <div class="alert alert-success">
            You must log in to continue.
        </div>
        @endif
        <form action="{{ route('signin') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="email" placeholder="Email address or phone number" class="form-control p-3" id="email" name="email" required>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" placeholder="Password" class="form-control p-3" id="password" name="password" required>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-full">Sign In</button>
        </form>
        <a href="/forget-password" class="text-center hover:underline">
            Forgotten account?
        </a>
        <div class="w-full h-[1px] bg-gray-500"></div>
        <button class="btn btn-primary mx-auto">Create new account</button>
    </div>
</div>
@endsection