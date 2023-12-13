<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $orderCounts = Transaction::selectRaw('DATE_FORMAT(created_at, "%M") as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderByRaw('MIN(created_at)')
        ->get();

        $allMonths = [
        'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $chartData = [
        'labels' => $allMonths,
        'datasets' => [
            [
                'label' => 'Orders',
                'fill' => false,
                'backgroundColor' => 'rgb(99 102 241)',
                'borderColor' => 'rgb(99 102 241)',
                'data' => array_fill(0, count($allMonths), 0),
            ],
        ],
        ];

        foreach ($orderCounts as $orderCount) {
            $monthIndex = array_search($orderCount->month, $allMonths);
            $chartData['datasets'][0]['data'][$monthIndex] = $orderCount->count;
        }

        $users = User::where('role', 'user')->get();
        $transactions = Transaction::get();

        return view('admin.dashboard', ['chartData' => $chartData, 'userCount' => $users->count(), 'transactionCount' => $transactions->count()]);
    }
}
