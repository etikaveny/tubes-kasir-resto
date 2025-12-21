<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        
        $totalSalesToday = Order::whereDate('created_at', $today)->sum('total_amount');
        $totalOrdersToday = Order::whereDate('created_at', $today)->count();
        $totalRefundsToday = Order::whereDate('created_at', $today)->where('payment_status', 'refunded')->sum('total_amount');
        
        $totalSalesMonth = Order::whereMonth('created_at', $today->month)->sum('total_amount');
        $totalOrdersMonth = Order::whereMonth('created_at', $today->month)->count();
        $totalRefundsMonth = Order::whereMonth('created_at', $today->month)->where('payment_status', 'refunded')->sum('total_amount');

        // Simple Staff Performance (Top 3 by order count this month)
        $topStaff = User::where('role', 'cashier')
            ->withCount(['orders' => function ($query) use ($today) {
                $query->whereMonth('created_at', $today->month);
            }])
            ->orderByDesc('orders_count')
            ->take(3)
            ->get();

        return view('manager.dashboard', compact(
            'totalSalesToday', 'totalOrdersToday', 'totalRefundsToday',
            'totalSalesMonth', 'totalOrdersMonth', 'totalRefundsMonth',
            'topStaff'
        ));
    }
}
