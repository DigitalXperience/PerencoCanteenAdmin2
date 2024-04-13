<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateUserNumber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-user-number';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::find(3); // Remplacez $userId par l'ID de l'utilisateur spécifique
        $user->tel = mt_rand(1000, 9999); // Génère un nouveau numéro aléatoire
        $user->save();

        $this->info('User number updated successfully!');
    }
}
