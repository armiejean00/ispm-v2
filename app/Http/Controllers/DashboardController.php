<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Desk;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        return view('/dashboard', [
            'cssPaths' => [
                'resources/css/main/content.css',
                'resources/css/main/content2.css',
                'resources/css/main/dashboard.css',
            ],
            'title' => 'Dashboard | ApexHubSpot',
            'totalBookings' => Booking::count(),
            'totalUsers' => User::count(),
            'totalDesks' => Desk::count(),
            'adminCount' => User::where('role', 'admin')->count(),
            'managerCount' => User::where('role', 'office_manager')->count(),
            'normal' => User::where('role', 'user')->count(),
             'super_admin' => User::where('role', 'super_admin')->count(),
            'disabled' => Desk::where('is_out_of_order', 1)->count(),
             'available' => Desk::where('is_out_of_order', 0)->count(),

             'bookings' => Booking::query()->where('user_id', auth()->id())
                                          ->orderBy('available_desk_id', 'asc')
                                          ->orderBy('desk_id', 'asc')
                                          ->paginate(3),
        ]);
    }
    

      
}
