<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User; // Assurez-vous d'importer le modèle User correctement.

class DeleteUsers extends Command
{
    /**
     * Le nom et la signature de la commande console.
     *
     * @var string
     */
    protected $signature = 'app:delete-users';

    /**
     * La description de la commande console.
     *
     * @var string
     */
    protected $description = 'Supprime tous les utilisateurs dont le statut est 0';

    /**
     * Exécute la commande console.
     */
    public function handle()
    {
        // Compte le nombre d'utilisateurs supprimés pour informer l'utilisateur.
        $count = User::where('status', 0)->delete();
        
        // Affiche un message dans la console pour informer de la suppression.
        $this->info("$count utilisateurs ont été supprimés.");
    }
}


