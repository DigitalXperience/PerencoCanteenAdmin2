<?php

namespace App\Http\Controllers;

use App\Models\UserLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminPagesController extends Controller
{
    public function users()
    {
        $users = User::where('statut', 1)->paginate(10);

        return view('admin.users.user', compact('users'));
    }



    public function showdel(){
        $users = User::where('statut', 0)->paginate(10);
        return view('admin.users.delete_users', compact('users'));
    }


    public function orders(){
        return view('admin.orders');
    }

    public function add(){
        return view('admin.users.add');
    }

    public function store(Request $request){


        if(auth()->check()){

            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'tel' => 'required|numeric',
                'usertype' => 'required',
                'compte' => 'required' // Ajout de l'attribut 'compte' dans les règles de validation
            ]);

            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->tel = $request->input('tel');
            $user->usertype = $request->input('usertype');
            $user->compte = $request->input('compte'); // Assignation de la valeur de 'compte'
            $user->save();

            return redirect('users')->with('success', 'Utilisateur créé avec succès');
        } else {
            return redirect()->back()->with('error', 'Accès non autorisé');
        }

    }

    public function edit_user($id){
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update_user(Request $request, $id){
        $user = User::find($id);
        if(!$user){
            return redirect()->back()->with('error', 'Utilisateur non trouvé');
        }

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'tel' => 'required|numeric',
            'usertype' => 'required',
            'manger' => 'required|boolean',
            'compte' => 'required'

        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->tel = $request->input('tel');
        $user->usertype = $request->input('usertype');
        $user->manger = $request->input('manger');
        $user->compte = $request->input('compte');
        $user->save();

        return redirect()->route('users')->with('success', 'Utilisateur mis à jour avec succès');
    }


    public function delete_user($id){
        $user = User::find($id);
        if($user){
            $user->statut = 0;
            $user->save();
            return redirect()->route('users')->with('success', 'Statut de l\'utilisateur modifié avec succès');
        } else {
            return redirect()->back()->with('error', 'Utilisateur non trouvé');
        }
    }

    public function get_user_logs(Request $request){
        $selectedDate = $request->input('selected_date', session('selected_date'));

        $userLogs = UserLog::join('users', 'user_logs.user_id', '=', 'users.id')
            ->select('user_logs.*', 'users.name', 'users.email')
            ->whereDate('user_logs.logged_at', '=', $selectedDate)
            ->orderBy('user_logs.logged_at', 'desc')
            ->paginate(10);

        session(['selected_date' => $selectedDate]);

        // Conserver les paramètres de filtrage et de pagination dans l'URL
        $userLogs->appends(['selected_date' => $selectedDate]);

        return view('admin.users.historique', ['userLogs' => $userLogs, 'selectedDate' => $selectedDate]);
    }


public function restore_user($id){
    $user = User::find($id);
    if($user && $user->statut == 0){
        $user->statut = 1;
        $user->save();
        return redirect()->route('users')->with('success', 'Utilisateur restauré avec succès');
    } else {
        return redirect()->back()->with('error', 'Utilisateur non trouvé ou déjà actif');
    }
}

    public function users_with_statut_1(){
        $total_users_statut_1 = User::where('statut', 1)->count();
        $users = User::where('statut', 1)->get();
        return view('admin.dashboard', ['users' => $users, 'total_users_statut_1' => $total_users_statut_1]);
    }


    public function users_with_statut_1_and_compte_1(){
        $total_users_statut_1_compte_1 = User::where('statut', 1)->where('compte', 1)->count();
        return view('admin.dashboard', ['total_users_statut_1_compte_1' => $total_users_statut_1_compte_1]);
    }


}



