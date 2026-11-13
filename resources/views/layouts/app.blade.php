<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Barangay Bulletin – Purok Amparo')</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
        <nav class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
                <a href="{{ route('posts.index') }}" class="text-lg font-semibold text-blue-700">
                    Barangay Bulletin – Purok Amparo
                </a>

                <div class="flex items-center gap-4">
                    @auth
                        <span class="text-sm text-slate-600">Hi, {{ auth()->user()->name }}</span>
                        @if (auth()->user()->author()->exists())
                            <a href="{{ route('posts.create') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">
                                New post
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-700">
                                Logout
                            </button>
                        </form>
                    @endauth

                    @guest
                        @unless (request()->routeIs('login'))
                            <a href="{{ route('login') }}" class="rounded-lg bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                                Sign in
                            </a>
                        @endunless
                    @endguest
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <footer class="border-t border-slate-200 bg-white">
            <div class="mx-auto max-w-7xl px-6 py-4 text-sm text-slate-500">
                Barangay Bulletin – Purok Amparo
            </div>
        </footer>
    </body>
</html>
