<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GraphController extends Controller
{
    public function showChart(Request $request)
    {
        $availableDates = UserLog::selectRaw('DISTINCT DATE(logged_at) as date')
            ->orderBy('date')
            ->pluck('date');


        $date = $request->input('date', Carbon::today()->toDateString());

        $mealsToday = UserLog::whereDate('logged_at', $date)->with('user')->get();

        $previousDate = Carbon::parse($date)->subDay();
        $mealsPrevious = UserLog::whereDate('logged_at', $previousDate)->with('user')->get();

        return view('admin.graph', compact('availableDates', 'mealsPrevious', 'date', 'mealsToday'));
    }

    public function getGraphData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $userLogs = UserLog::whereBetween('logged_at', [$startDate, $endDate])
            ->selectRaw('DATE(logged_at) as date, COUNT(user_id) as user_count')
            ->groupBy('date')
            ->get();

        $maxUsers = User::count();

        $userPercentages = $userLogs->map(function ($log) use ($maxUsers) {
            return round(($log->user_count / $maxUsers) * 100, 2);
        });

        return response()->json([
            'dates' => $userLogs->pluck('date'),
            'userCounts' => $userLogs->pluck('user_count'),
            'userPercentages' => $userPercentages,
        ]);

    }


    public function getUserCount(Request $request)
    {
        $selectedDate = $request->input('date');
        $userCount = UserLog::whereDate('logged_at', $selectedDate)->count();

        return response()->json(['userCount' => $userCount]);
    }

    public function getDoughnutData(Request $request, $specificDate)
    {
        $userCount = UserLog::whereDate('logged_at', $specificDate)->count();
        $totalUsers = User::count();

        $data = [
            'userCount' => $userCount,
            'totalUsers' => $totalUsers,
        ];

        return response()->json($data);
    }


    public function eat(Request $request)
    {
        $date = $request->input('date');
        $name = $request->input('name');
        $email = $request->input('email');

        $query = UserLog::query();

        if ($date) {
            $query->whereDate('date', $date);
        }

        if ($name) {
            $query->whereHas('user', function ($q) use ($name) {
                $q->where('name', 'like', '%'.$name.'%');
            });
        }

        if ($email) {
            $query->whereHas('user', function ($q) use ($email) {
                $q->where('email', 'like', '%'.$email.'%');
            });
        }

        $meals = $query->with('user')->paginate(10);

        return view('admin.graph', compact('meals'));
    }

}
