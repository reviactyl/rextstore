@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">

    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100 mb-6">
        Login to Continue
    </h2>

    @if ($errors->any())
    <div class="mb-6 flex gap-3 rounded-xl border border-red-300 bg-red-50 dark:bg-red-950/30 dark:border-red-900 p-4">
        <x-tabler-info-circle-f class="w-5 h-5 text-red-600 dark:text-red-400 mt-0.5" />

        <div>
            <div class="font-medium text-red-700 dark:text-red-300">
                Failed to Login
            </div>

            <ul class="list-disc ml-5 text-sm text-red-600 dark:text-red-400 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-800 p-6">

        <div class="flex justify-center">
            <div class="w-full max-w-lg">

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">
                            Email Address
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            class="w-full rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 px-3 py-2 text-sm text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-primary-500 focus:outline-none {{ $errors->has('email') ? 'ring-2 ring-red-500' : '' }}"
                            placeholder="you@example.com"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            required
                            class="w-full rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 px-3 py-2 text-sm text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-primary-500 focus:outline-none {{ $errors->has('password') ? 'ring-2 ring-red-500' : '' }}"
                            placeholder="••••••••"
                        >
                    </div>

                    <div class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            class="rounded border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900"
                        >

                        <label class="text-sm text-zinc-700 dark:text-zinc-300">
                            Remember me
                        </label>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium
                                   bg-zinc-900 text-white hover:bg-zinc-800
                                   dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-zinc-200
                                   transition">
                            Sign In
                        </button>

                        <a href="#"
                           class="text-sm text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100">
                            Forgot password?
                        </a>
                    </div>

                </form>

                <div class="my-6 flex items-center gap-4">
                    <div class="flex-1 h-px bg-zinc-200 dark:bg-zinc-800"></div>
                    <span class="text-xs text-zinc-500 dark:text-zinc-400">
                        Don't have an account?
                    </span>
                    <div class="flex-1 h-px bg-zinc-200 dark:bg-zinc-800"></div>
                </div>

                <div class="text-center">
                    <a href="{{ route('register') }}"
                       class="inline-flex px-5 py-2 rounded-lg text-sm font-medium
                              bg-zinc-900 text-white hover:bg-zinc-800
                              dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-zinc-200 transition">
                        Create New Account
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
