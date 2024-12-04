@extends('layouts.auth')

<div class="container">
    <h1>Company Details</h1>
    <div>
        <h2>{{ $company->name }}</h2>
        <p>{{ $company->address }}</p>
    </div>
    <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back to List</a>
</div>