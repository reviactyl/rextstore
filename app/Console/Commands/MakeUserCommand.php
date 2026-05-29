<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Validation\ValidationException;

#[Signature('user:make {--email=} {--username=} {--name=} {--password=} {--admin=}')]
#[Description('Create a user account')]
class MakeUserCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email') ?: $this->ask('Email');
        $username = $this->option('username') ?: $this->ask('Username', $email);
        $name = $this->option('name') ?: $this->ask('Name', $username);
        $password = $this->option('password') ?: $this->secret('Password');
        $admin = $this->parseAdminOption($this->option('admin'));

        if ($password === null || $password === '') {
            $this->error('Password is required.');

            return self::FAILURE;
        }

        try {
            validator(
                [
                    'email' => $email,
                    'username' => $username,
                    'name' => $name,
                    'password' => $password,
                ],
                [
                    'email' => ['required', 'email', 'unique:users,email'],
                    'username' => ['required', 'string', 'max:255', 'unique:users,username'],
                    'name' => ['required', 'string', 'max:255'],
                    'password' => ['required', 'string'],
                ],
            )->validate();
        } catch (ValidationException $exception) {
            foreach ($exception->validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $user = User::create([
            'email' => $email,
            'username' => $username,
            'name' => $name,
            'password' => $password,
        ]);

        $user->forceFill([
            'root_admin' => $admin,
        ])->save();

        $this->info(sprintf(
            'User %s created%s.',
            $user->email,
            $user->root_admin ? ' as an admin' : '',
        ));

        return self::SUCCESS;
    }

    private function parseAdminOption(?string $value): bool
    {
        if ($value === null || $value === '') {
            return $this->confirm('Admin?', false);
        }

        return in_array(strtolower($value), ['1', 'true', 'yes', 'y'], true);
    }
}
