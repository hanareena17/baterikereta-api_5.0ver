<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\UserPoint;
use Illuminate\Support\Str;

class GrantUserPoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:grant-points {userId} {points}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grant a specified number of points to a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->argument('userId');
        $pointsToAdd = (int) $this->argument('points');

        if (!Str::isUuid($userId)) {
            $this->error('Invalid User ID format. Please provide a valid UUID.');
            return 1;
        }

        $user = User::find($userId);

        if (!$user) {
            $this->error("User with ID {$userId} not found.");
            return 1;
        }

        if ($pointsToAdd <= 0) {
            $this->error("Points to add must be a positive integer.");
            return 1;
        }

        $userPoints = UserPoint::firstOrCreate(
            ['user_id' => $user->id],
            ['points' => 0]
        );

        $userPoints->points += $pointsToAdd;
        $userPoints->save();

        $this->info("Successfully granted {$pointsToAdd} points to user {$user->name} (ID: {$userId}). New balance: {$userPoints->points} points.");
        return 0;
    }
}
