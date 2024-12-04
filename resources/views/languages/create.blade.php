@extends('layouts.workspace')

@section('title', 'Create Language')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Create Language</h1>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('languages.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
            <div class="invalid-feedback">Please enter the language name.</div>
        </div>
        <div class="mb-3">
            <label for="keyword" class="form-label">Keyword</label>
            <input type="text" name="keyword" class="form-control" id="keyword" value="{{ old('keyword') }}">
        </div>
        <div class="form-check mb-3">
            <input type="hidden" name="isPublic" value="0">
            <input type="checkbox" name="isPublic" class="form-check-input" id="isPublic" value="1" {{ old('isPublic') ? 'checked' : '' }}>
            <label class="form-check-label" for="isPublic">Public</label>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection