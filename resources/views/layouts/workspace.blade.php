<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @livewireStyles
</head>

<body class="h-screen w-screen">
    <div class="flex w-full h-full">
        <aside class="w-[250px] flex flex-col space-y-2 cart-bg p-1">
            <div class="flex gap-2 items-center">
                <div class="py-2 px-4">I</div>
                <a class="text-lg font-semibold">Admin</a>
            </div>
            @foreach (config('workspaces') as $link)
            <a class="p-2 {{ request()->is(trim($link['url'], '/')) ? 'bg-blue-600 rounded-sm text-white' : '' }}"
                href="{{ $link['url'] }}">
                {{ $link['label'] }}
            </a>
            @endforeach
        </aside>
        <div class="flex-1 h-full">
            <nav class="navbar navbar-expand-lg bg-body-tertiary h-[60px]">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <a
                        class="p-2"
                        href="/app/home">
                        Enter Company
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <form action="{{ route('signout') }}" method="POST" class="px-4"> @csrf <button type="submit" class="h-12 whitespace-nowrap w-full">Sign Out</button> </form>
            </nav>
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
@livewireScripts

</html>