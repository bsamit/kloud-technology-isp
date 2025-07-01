<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Helpdesk\Ticket;
use App\Models\Package\Package;
use App\Models\PurchasePackage;
use App\Models\Package\Packages;
use App\Models\PotentialCustomer;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role_id == 4) {
            // Customer Dashboard
            $currentPackage = PurchasePackage::with(['package' => function($query) {
                    $query->withTrashed(); // Include soft deleted packages
                }])
                ->where('user_id', $user->id)
                ->where(function($query) {
                    $query->where('status', 'active')
                        ->orWhere(function($q) {
                            $q->where('start_date', '<=', now())
                                ->where('end_date', '>=', now());
                        });
                })
                ->latest()
                ->first();

            // Debug information
            if (!$currentPackage) {
                // Check if there are any packages at all for this user
                $allPackages = PurchasePackage::where('user_id', $user->id)->get();
                if ($allPackages->isEmpty()) {
                    \Log::info('No packages found for user: ' . $user->id);
                } else {
                    foreach ($allPackages as $pkg) {
                        \Log::info('Package found:', [
                            'id' => $pkg->id,
                            'status' => $pkg->status,
                            'start_date' => $pkg->start_date,
                            'end_date' => $pkg->end_date,
                            'package_id' => $pkg->package_id
                        ]);
                    }
                }
            }

            $billingHistory = Bill::with(['purchasePackage', 'package' => function($query) {
                    $query->withTrashed(); // Include soft deleted packages
                }, 'payment'])
                ->where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get();

            $data = [
                'currentPackage' => $currentPackage,
                'billingHistory' => $billingHistory,
                'pendingTickets' => Ticket::where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->count()
            ];

            // Add debug data
            if ($currentPackage) {
                $data['debug'] = [
                    'package_id' => $currentPackage->package_id,
                    'package_exists' => $currentPackage->package !== null,
                    'package_name' => optional($currentPackage->package)->name,
                    'status' => $currentPackage->status,
                    'dates' => [
                        'start' => $currentPackage->start_date,
                        'end' => $currentPackage->end_date,
                        'now' => now()
                    ]
                ];
            }
            return view('backEnd.content.customer_dashboard_content', $data);
        } else {
            // Admin Dashboard
            // Get all dates of current month
            $currentMonth = Carbon::now();
            $dates = collect(range(1, $currentMonth->daysInMonth))->map(function ($day) use ($currentMonth) {
                return Carbon::create($currentMonth->year, $currentMonth->month, $day);
            });

            $dailyStats = $dates->map(function ($date) {
                return [
                    'date' => $date->format('M d'),
                    'day_name' => $date->format('D'),
                    'new_customers' => User::where('role_id', 4)
                        ->whereDate('created_at', $date->format('Y-m-d'))
                        ->count(),
                    'completed_payments' => Payment::whereDate('created_at', $date->format('Y-m-d'))
                        ->where('status', 'completed')
                        ->count()
                ];
            });

            $data = [
                'totalCustomers' => User::where('role_id', 4)->count(),
                'totalPackages' => Packages::count(),
                'pendingTickets' => Ticket::where('status', 'pending')->count(),
                'potentialCustomers' => PotentialCustomer::count(),
                'activePackages' => PurchasePackage::where('status', 'active')
                    ->where('start_date', '<=', Carbon::now())
                    ->where('end_date', '>=', Carbon::now())
                    ->count(),
                'recentTickets' => Ticket::latest()->take(5)->get(),
                'dailyStats' => $dailyStats
            ];

            return view('backEnd.content.dashboard_content', $data);
        }
    }
}
