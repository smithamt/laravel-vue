@extends('layouts.workspace')

@section('title', 'Edit Language')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Language</h1>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('languages.update', $language->id) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $language->name) }}" required>
            <div class="invalid-feedback">Please enter the language name.</div>
        </div>
        <div class="mb-3">
            <label for="keyword" class="form-label">Keyword</label>
            <input type="text" name="keyword" class="form-control" id="keyword" value="{{ old('keyword', $language->keyword) }}">
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" name="isPublic" class="form-check-input" id="isPublic" {{ old('isPublic', $language->isPublic) ? 'checked' : '' }}>
            <label class="form-check-label" for="isPublic">Public</label>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection