<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date');
        $today = $date ? Carbon::parse($date) : Carbon::today();

        $totalSalesToday = Order::whereDate('created_at', $today)->sum('total_amount');
        $totalOrdersToday = Order::whereDate('created_at', $today)->count();
        $totalRefundsToday = Order::whereDate('created_at', $today)->where('payment_status', 'refunded')->sum('total_amount');

        $totalSalesMonth = Order::whereMonth('created_at', $today->month)->whereYear('created_at', $today->year)->sum('total_amount');
        $totalOrdersMonth = Order::whereMonth('created_at', $today->month)->whereYear('created_at', $today->year)->count();
        $totalRefundsMonth = Order::whereMonth('created_at', $today->month)->whereYear('created_at', $today->year)->where('payment_status', 'refunded')->sum('total_amount');

        // Simple Staff Performance (Top 3 by order count this month of selected date)
        $topStaff = User::whereIn('role', ['cashier', 'manager']) // Include manager if they sell?
            ->withCount([
                'orders' => function ($query) use ($today) {
                    $query->whereMonth('created_at', $today->month)->whereYear('created_at', $today->year);
                }
            ])
            ->orderByDesc('orders_count')
            ->take(3)
            ->get();


        // Chart Data: Orders per hour for selected date
        $ordersPerHour = Order::selectRaw('HOUR(created_at) as hour, count(*) as count')
            ->whereDate('created_at', $today)
            ->groupBy('hour')
            ->orderBy('hour')
            ->pluck('count', 'hour');

        // Initialize array for hours 08:00 to 23:00
        $chartLabels = [];
        $chartData = [];

        for ($i = 8; $i <= 23; $i++) {
            $chartLabels[] = sprintf('%02d:00', $i);
            $chartData[] = $ordersPerHour->get($i, 0);
        }

        // Current Date for display
        Carbon::setLocale('id'); // Attempt to set ID, fallback to EN if not installed
        $dateLabel = $today->translatedFormat('l, d F Y');

        return view('manager.dashboard', compact(
            'totalSalesToday',
            'totalOrdersToday',
            'totalRefundsToday',
            'totalSalesMonth',
            'totalOrdersMonth',
            'totalRefundsMonth',
            'topStaff',
            'chartLabels',
            'chartData',
            'dateLabel',
            'today'
        ));
    }
}
