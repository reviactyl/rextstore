<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('shows the login page', function () {
    $this->get(route('login'))
        ->assertOk();
});

it('shows the register page', function () {
    $this->get(route('register'))
        ->assertOk();
});

it('registers a new user and logs them in', function () {
    $response = $this->withSession(['_token' => 'test-token'])->post(route('register'), [
        '_token' => 'test-token',
        'name' => 'Test User',
        'username' => 'testuser',
        'email' => 'test@example.com',
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
    ]);

    $response->assertRedirect(route('home'));

    $user = User::where('email', 'test@example.com')->first();

    expect($user)->not->toBeNull();
    expect(Hash::check('Password123!', $user->password))->toBeTrue();

    $this->assertAuthenticatedAs($user);
});

it('logs in an existing user with valid credentials', function () {
    $user = User::factory()->create([
        'password' => Hash::make('Password123!'),
    ]);

    $response = $this->withSession(['_token' => 'test-token'])->post(route('login'), [
        '_token' => 'test-token',
        'email' => $user->email,
        'password' => 'Password123!',
    ]);

    $response->assertRedirect(route('home'));
    $this->assertAuthenticatedAs($user);
});

it('rejects invalid login credentials', function () {
    $user = User::factory()->create([
        'password' => Hash::make('Password123!'),
    ]);

    $response = $this->from(route('login'))->withSession(['_token' => 'test-token'])->post(route('login'), [
        '_token' => 'test-token',
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertRedirect(route('login'));
    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

it('does not allow guests to call logout', function () {
    $this->withSession(['_token' => 'test-token'])->post(route('logout'), [
        '_token' => 'test-token',
    ])
        ->assertRedirect(route('login'));
});

it('logs out an authenticated user', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->withSession(['_token' => 'test-token'])->post(route('logout'), [
        '_token' => 'test-token',
    ]);

    $response->assertRedirect(route('home'));
    $this->assertGuest();
});
