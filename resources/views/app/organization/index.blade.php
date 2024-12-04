@extends('layouts.app')

@section('title')
Organization
@endsection

@section('content')
<div class="w-full h-full flex">
    <aside class="w-[250px] p-2 gap-2 flex flex-col">
        @foreach (config('organization') as $link)
        <a
            class="p-2 {{ str_contains(request()->path(), $link['url']) ? 'bg-blue-600 rounded-sm text-white' : '' }}"
            href="/app/organization/{{ $link['url'] }}" href="{{ $link['url'] }}"
            wire:navigate>
            {{ $link['label'] }}
        </a>
        @endforeach
    </aside>
    <div class="flex-1">
        @yield('organization-content')
    </div>
</div>
@endsection