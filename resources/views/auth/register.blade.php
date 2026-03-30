@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">

    <h2 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100 mb-6">
        Create an Account
    </h2>

    @if ($errors->any())
    <div class="mb-6 flex gap-3 rounded-xl border border-red-300 bg-red-50 dark:bg-red-950/30 dark:border-red-900 p-4">
        <x-tabler-info-circle-f class="w-5 h-5 text-red-600 dark:text-red-400 mt-0.5" />

        <div>
            <div class="font-medium text-red-700 dark:text-red-300">
                Failed to Register
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

                <form action="{{ route('register') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">
                            Full Name
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 px-3 py-2 text-sm text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-primary-500 focus:outline-none {{ $errors->has('name') ? 'ring-2 ring-red-500' : '' }}"
                               placeholder="John Doe">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">
                            Username
                        </label>
                        <input type="text" name="username" value="{{ old('username') }}" required
                               class="w-full rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 px-3 py-2 text-sm text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-primary-500 focus:outline-none {{ $errors->has('username') ? 'ring-2 ring-red-500' : '' }}"
                               placeholder="john.doe">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">
                            Email Address
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 px-3 py-2 text-sm text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-primary-500 focus:outline-none {{ $errors->has('email') ? 'ring-2 ring-red-500' : '' }}"
                               placeholder="you@example.com">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">
                            Password
                        </label>
                        <input type="password" name="password" required
                               class="w-full rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 px-3 py-2 text-sm text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-primary-500 focus:outline-none {{ $errors->has('password') ? 'ring-2 ring-red-500' : '' }}"
                               placeholder="••••••••">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">
                            Confirm Password
                        </label>
                        <input type="password" name="password_confirmation" required
                               class="w-full rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-950 px-3 py-2 text-sm text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-primary-500 focus:outline-none {{ $errors->has('password_confirmation') ? 'ring-2 ring-red-500' : '' }}"
                               placeholder="••••••••">
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="terms" required
                               class="rounded border-zinc-300 dark:border-zinc-700">
                        <label class="text-sm text-zinc-700 dark:text-zinc-300">
                            I agree to the Rextstore's Code of Conduct, Terms of Service, and Privacy Policy.
                        </label>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium
                                       bg-zinc-900 text-white hover:bg-zinc-800
                                       dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-zinc-200 transition">
                            Create Account
                        </button>
                    </div>

                </form>

                <div class="my-6 flex items-center gap-4">
                    <div class="flex-1 h-px bg-zinc-200 dark:bg-zinc-800"></div>
                    <span class="text-xs text-zinc-500 dark:text-zinc-400">
                        Already have an account?
                    </span>
                    <div class="flex-1 h-px bg-zinc-200 dark:bg-zinc-800"></div>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}"
                       class="inline-flex px-5 py-2 rounded-lg text-sm font-medium
                              bg-zinc-900 text-white hover:bg-zinc-800
                              dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-zinc-200 transition">
                        Sign In
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
