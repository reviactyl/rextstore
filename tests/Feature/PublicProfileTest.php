<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows a public profile by username', function () {
    $user = User::factory()->create([
        'name' => 'Jane Doe',
        'username' => 'janedoe',
    ]);

    $this->get('/@' . $user->username)
        ->assertOk()
        ->assertSee('Jane Doe')
        ->assertSee('@janedoe');
});

it('returns not found for unknown username profile', function () {
    $this->get('/@pterodactyl-got-injured')->assertNotFound();
});
