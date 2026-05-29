@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="flex flex-col min-h-screen h-full">
    <div class="my-auto mx-auto">

        @if ($errors->any())
            <div class="mb-6 flex gap-3 rounded-xl border border-red-300 bg-red-50 dark:bg-red-950/30 dark:border-red-900 p-4">
                <x-tabler-info-circle-filled class="w-5 h-5 text-red-600 dark:text-red-400 mt-0.5" />

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

        <div class="max-w-[450px] w-screen p-5">
            <div class="flex gap-x-2 pb-5">
                <x-logo />
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="bg-zinc-800 border border-zinc-700 rounded-xl p-5 space-y-3">
                    <h2 class="text-3xl text-center pb-3 font-semibold text-zinc-100">
                        Login to Continue
                    </h2>

                    <div>
                        <label class="block text-sm font-medium text-zinc-300 mb-1">
                            Email Address
                        </label>

                        <div class="flex items-center">
                            <div class="bg-zinc-800 border border-r-0 rounded-l-xl p-3 {{ $errors->has('email') ? 'border-red-400 text-red-400' : 'border-zinc-700 text-zinc-500' }}">
                                <x-tabler-mail class="w-5 h-5" />
                            </div>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                placeholder="you@example.com"
                                class="appearance-none outline-none w-full min-w-0 p-3 rounded-r-xl border text-sm transition-all duration-150
                                bg-white/5 border-zinc-700 hover:border-zinc-400 text-zinc-200
                                focus:border-primary-300 focus:ring-2 focus:ring-primary-400/50 focus:outline-none
                                {{ $errors->has('email')
                                    ? 'border-red-400 hover:border-red-300 text-red-100 focus:border-red-300 focus:ring-red-200/50'
                                    : ''
                                }}"
                            >
                        </div>

                        @error('email')
                            <p class="mt-1 text-xs text-red-200">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-300 mb-1">
                            Password
                        </label>

                        <div class="flex items-center">
                            <div class="bg-zinc-800 border border-r-0 rounded-l-xl p-3 {{ $errors->has('password') ? 'border-red-400 text-red-400' : 'border-zinc-700 text-zinc-500' }}">
                                <x-tabler-lock class="w-5 h-5" />
                            </div>

                            <input
                                type="password"
                                name="password"
                                required
                                placeholder="••••••••"
                                class="appearance-none outline-none w-full min-w-0 p-3 rounded-r-xl border text-sm transition-all duration-150
                                bg-white/5 border-zinc-700 hover:border-zinc-400 text-zinc-200
                                focus:border-primary-300 focus:ring-2 focus:ring-primary-400/50 focus:outline-none
                                {{ $errors->has('password')
                                    ? 'border-red-400 hover:border-red-300 text-red-100 focus:border-red-300 focus:ring-red-200/50'
                                    : ''
                                }}"
                            >
                        </div>

                        @error('password')
                            <p class="mt-1 text-xs text-red-200">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            {{ old('remember') ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-zinc-700 bg-zinc-700 text-primary-500 focus:ring-primary-500"
                        >

                        <label class="text-sm text-zinc-300">
                            Remember me
                        </label>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 text-white rounded-xl w-full py-2 font-semibold cursor-pointer">Login</button>
                    </div>

                    <div class="mt-1 flex flex-col items-center gap-2">
                        <a href="#" class="text-sm text-blue-500 tracking-wide no-underline hover:text-blue-400">
                            Forgot Password?
                        </a>

                        <a href="{{ route('register') }}" class="text-xs text-zinc-400 tracking-wide no-underline hover:text-zinc-300">
                            Don't have an account? Create one
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
