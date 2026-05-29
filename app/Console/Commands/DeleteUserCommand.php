<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('user:delete {--user=}')]
#[Description('Delete a user account')]
class DeleteUserCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $identifier = $this->option('user') ?: $this->ask('User ID, email, or username');

        if ($identifier === null || $identifier === '') {
            $this->error('User is required.');

            return self::FAILURE;
        }

        $user = User::query()
            ->where('id', $identifier)
            ->orWhere('email', $identifier)
            ->orWhere('username', $identifier)
            ->first();

        if (! $user) {
            $this->error(sprintf('User "%s" was not found.', $identifier));

            return self::FAILURE;
        }

        if (! $this->confirm(sprintf('Delete user %s?', $user->email), false)) {
            $this->info('User deletion cancelled.');

            return self::SUCCESS;
        }

        $user->delete();

        $this->info(sprintf('User %s deleted.', $user->email));

        return self::SUCCESS;
    }
}
