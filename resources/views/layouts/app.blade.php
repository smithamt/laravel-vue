<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @livewireStyles
    <style>
        .open {
            width: 50px;
        }
    </style>
</head>

<body class="h-screen w-screen">
    <main x-data="{ open: false }" id="app" class="h-full w-full">
        <nav class="h-12 cart-bg flex items-center shadow-sm border-b px-2">
            <button type="button" @click="open = !open">Toggle Btn</button>
        </nav>
        <div class="flex h-full w-full">
            <aside :class="{ 'open': open }"
                class="flex w-[50px] flex-col xl:w-[180px] p-1 space-y-1 cart-bg shadow-sm">
                @foreach (config('links') as $link)
                <a
                    class="p-2 flex items-center transition-all duration-75 ease-in-out h-10 
                {{ str_contains(request()->path(), $link['url']) ? 'bg-blue-600 font-semibold rounded-sm text-white' : '' }}"
                    :class="{ 'justify-center': open }"
                    href="/app{{ $link['url'] }}"
                    wire:navigate>
                    <svg width="20px" height="20px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1 6V15H6V11C6 9.89543 6.89543 9 8 9C9.10457 9 10 9.89543 10 11V15H15V6L8 0L1 6Z"
                            fill="{{ str_contains(request()->path(), $link['url']) ? 'white' : 'black' }}" />
                    </svg>
                    <span :class="{ 'hidden': open }" class="px-3">
                        {{ $link['label'] }}
                    </span>
                </a>
                @endforeach
                <form action="{{ route('app.signout') }}" method="POST" class="px-4">
                    @csrf
                    <button type="submit" class="h-12 whitespace-nowrap w-full">Sign Out</button>
                </form>
            </aside>
            <div class="flex-1">

                @yield('content')
            </div>
        </div>
    </main>

    @yield('script')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    @livewireScripts
</body>

</html>