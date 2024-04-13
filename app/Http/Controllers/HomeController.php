<?php

namespace App\Http\Controllers;

use App\Models\UserLog;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $userLogs = UserLog::join('users', 'user_logs.user_id', '=', 'users.id')
            ->select('user_logs.*', 'users.name', 'users.email')
            ->orderBy('user_logs.logged_at', 'desc')
            ->take(10)
            ->get();
        $logs = DB::table('user_logs')->count();
        $total_users = User::where(function($query) {
            $query->where('compte', 0)->orWhere('compte', 1);
        })->where('statut', 1)->count();
        $total_users_del = User::where(function($query) {

        })->where('statut', 0)->count();
        $dates = UserLog::selectRaw('DATE(logged_at) as date')
            ->distinct()
            ->pluck('date');
        if(Auth::id())
        {
            $usertype = Auth()->user()->usertype;

            if ($usertype== 'user'){
                return view('admin.dashboard', compact('logs', 'dates', 'total_users', 'total_users_del', 'userLogs'));
            }

            else if ($usertype== 'admin'){

                return view('admin.dashboard', compact('logs', 'dates', 'total_users', 'total_users_del', 'userLogs'));
            }
            else {
                return redirect()->back();
            }
        }
    }



}
