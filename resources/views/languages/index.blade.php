@extends('layouts.workspace')

@section('title', 'Languages')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Languages</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="d-flex justify-content-between mb-3">
        <h2>Language List</h2>
        <a href="{{ route('languages.create') }}" class="btn btn-primary">Create Language</a>
    </div>
    <ul class="list-group">
        @foreach($languages as $language)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $language->name }}
            <div class="btn-group flex gap-2" role="group">
                <a href="{{ route('languages.show', $language->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('languages.edit', $language->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('languages.destroy', $language->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection
