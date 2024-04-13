<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userlogseed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $users = DB::table('users')->pluck('id')->toArray();
    $dates = [];

    $debutAnnee = now()->startOfYear();
    $finAvril = now()->startOfYear()->addMonths(4)->subDay();

    foreach ($users as $user) {
        $dateDebut = $debutAnnee->copy();
        while ($dateDebut->lte($finAvril)) {
            if (rand(0, 1)) { // 50% de chance pour qu'un utilisateur mange ce jour-là
                $date = $dateDebut->format('Y-m-d');
                $key = $user . '_' . $date;
                if (!isset($dates[$key])) {
                    DB::table('user_logs')->insert([
                        'user_id' => $user,
                        'logged_at' => $date,
                    ]);
                    $dates[$key] = true;
                }
            }
            $dateDebut->addDay(); // Passe au jour suivant
        }
    }
}
}
