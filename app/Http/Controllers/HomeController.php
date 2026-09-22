<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vehicle;
use App\Models\service;
use App\Models\fuel;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceRequest;
use App\Models\vehiclerequests;

class HomeController extends Controller
{
    //
    public function dashboard()
    {
        $totalVehicles = vehicle::count();
        $totalservicescosts = service::sum('cost');
        $totalfuelscosts = fuel::sum('cost');


        $user = Auth::user();
        $isAdmin = in_array($user->role, ['system_admin', 'transport_officer']);

        $recentServices = ServiceRequest::query()
            ->when(!$isAdmin, function ($query) use ($user) {

                if ($user->role === 'driver') {
                    return $query->where('driver_id', $user->id);
                }
                if ($user->role === 'staff') {
                    return $query->whereRaw('1 = 0');
                }

                return $query;
            })
            ->latest()
            ->take(5)
            ->get();


        $recentVehicleRequests = vehiclerequests::query()
            ->when(!$isAdmin, function ($query) use ($user) {

                if ($user->role === 'driver') {
                    return $query->where('driver_id', $user->id);
                }

                if ($user->role === 'staff') {
                    return $query->where('user_id', $user->id);
                }

                return $query;
            })
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalVehicles',
            'totalservicescosts',
            'totalfuelscosts',
            'recentServices',
            'recentVehicleRequests'
        ));
    }
}
