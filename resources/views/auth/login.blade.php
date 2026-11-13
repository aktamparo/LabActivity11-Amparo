@extends('layouts.app')

@section('title', 'Sign in – Barangay Bulletin')

@section('content')
    <main class="min-h-screen bg-slate-50 px-6 py-10">
        <form method="POST" action="{{ url('/login') }}" class="mx-auto max-w-sm space-y-4 rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            @csrf

            <div>
                <h1 class="text-2xl font-bold text-slate-900">Sign in</h1>
                <p class="mt-1 text-sm text-slate-600">Access the Barangay Bulletin.</p>
            </div>

            <div>
                <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Email"
                    required
                    autofocus
                    class="w-full rounded-lg border border-slate-300 p-2 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                    class="w-full rounded-lg border border-slate-300 p-2 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200"
                >
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full rounded-lg bg-blue-600 p-2 font-semibold text-white hover:bg-blue-700">
                Sign in
            </button>
        </form>
    </main>
@endsection
