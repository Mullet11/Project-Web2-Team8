<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\ViewModels\DashboardViewModel;

class DashboardController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $formattedRooms = DashboardViewModel::formatRooms($rooms);

        return view('dashboard.index', [
            'rooms' => $formattedRooms,
        ]);
    }
}
