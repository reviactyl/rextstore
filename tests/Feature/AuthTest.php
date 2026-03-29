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
    $response = $this->post(route('register'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
    ]);

    $response->assertRedirect(route('welcome'));

    $user = User::where('email', 'test@example.com')->first();

    expect($user)->not->toBeNull();
    expect(Hash::check('Password123!', $user->password))->toBeTrue();

    $this->assertAuthenticatedAs($user);
});

it('logs in an existing user with valid credentials', function () {
    $user = User::factory()->create([
        'password' => Hash::make('Password123!'),
    ]);

    $response = $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'Password123!',
    ]);

    $response->assertRedirect(route('welcome'));
    $this->assertAuthenticatedAs($user);
});

it('rejects invalid login credentials', function () {
    $user = User::factory()->create([
        'password' => Hash::make('Password123!'),
    ]);

    $response = $this->from(route('login'))->post(route('login'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertRedirect(route('login'));
    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

it('does not allow guests to call logout', function () {
    $this->post(route('logout'))
        ->assertRedirect(route('login'));
});

it('logs out an authenticated user', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('logout'));

    $response->assertRedirect(route('welcome'));
    $this->assertGuest();
});
