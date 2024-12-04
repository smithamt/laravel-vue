@extends('layouts.workspace')

@section('title')
Language Detail
@endsection

@section('content')
<div>
    <h1>{{ $language->name }}</h1>
    <p>Keyword: {{ $language->keyword }}</p>
    <p>Public: {{ $language->isPublic ? 'Yes' : 'No' }}</p>
    <a href="{{ route('languages.index') }}">Back to list</a>
</div>
@endsection