<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::query()
            ->where('statut', 1)
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%");
            })
            ->paginate(10); // 10 utilisateurs par page par exemple

        return view('admin.users.user', compact('users', 'query'));
    }

    public function searchdel(Request $request){
        $query = $request->input('query');

        $users = User::query()
            ->where('statut', 0)
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%");
            })
            ->paginate(10); // 10 utilisateurs par page par exemple

        // Conserver les paramètres de recherche et de pagination dans l'URL
        $users->appends(['query' => $query]);

        return view('admin.users.delete_users', compact('users', 'query'));
    }


    public function filter_user_logs(Request $request)
    {
        $selectedDate = $request->input('selected_date', session('selected_date'));

        $userLogs = UserLog::join('users', 'user_logs.user_id', '=', 'users.id')
            ->whereDate('user_logs.logged_at', '=', $selectedDate)
            ->select('user_logs.*', 'users.name', 'users.email')
            ->paginate(10);

        session(['selected_date' => $selectedDate]);

        // Conserver les paramètres de filtre dans l'URL pour chaque lien de pagination
        $userLogs->appends(['selected_date' => $selectedDate]);

        return view('admin.users.historique', compact('userLogs', 'selectedDate'));
    }



    public function searchByNameAndEmail(Request $request){
        $query = $request->input('query');

        $users = User::query()
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%");
            })
            ->paginate(10);

        // Conserver le paramètre de recherche dans l'URL pour la pagination
        $users->appends(['query' => $query]);

        return view('admin.users.historique', compact('users', 'query'));
    }

}
