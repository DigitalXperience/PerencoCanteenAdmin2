<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserLog;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if ($user->isDirty('manger') && $user->manger == 1) {
            $userLog = UserLog::where('user_id', $user->id)
                ->whereDate('logged_at', now()->toDateString())
                ->first();

            if (!$userLog) {
                UserLog::create([
                    'user_id' => $user->id,
                    'logged_at' => now()
                ]);
            } else {
                // Empêcher le changement du statut manger
                $user->manger = 0;
                $user->save();
            }
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
