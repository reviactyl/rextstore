@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
		<h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Welcome to Rextstore</h1>

		@if (session('success'))
			<p class="mt-4 rounded-md bg-green-100 px-4 py-2 text-sm text-green-800 dark:bg-green-900/40 dark:text-green-300">
				{{ session('success') }}
			</p>
		@endif

		<div class="mt-6 flex items-center gap-3">
			@auth
				<span class="text-sm text-zinc-600 dark:text-zinc-300">
					Signed in as {{ auth()->user()->email }}
				</span>
				<form method="POST" action="{{ route('logout') }}">
					@csrf
					<button type="submit" class="rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
						Logout
					</button>
				</form>
			@else
				<a href="{{ route('login') }}" class="rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-700 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-zinc-300">
					Login
				</a>
				<a href="{{ route('register') }}" class="rounded-md border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-800 hover:bg-zinc-100 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-700">
					Register
				</a>
			@endauth
		</div>
@endsection
