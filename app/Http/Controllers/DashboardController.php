<?php

namespace App\Http\Controllers;

use App\Application\Dashboard\GetDashboardData;
use App\ViewModels\DashboardViewModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama
     */
    public function index(GetDashboardData $getDashboardData)
    {
        // 1. Dapatkan data murni dari database lewat Use Case
        $rooms = $getDashboardData->execute();

        // 2. Format data tersebut menggunakan ViewModel
        $viewModel = new DashboardViewModel($rooms);

        // 3. Kirim ke View Blade
        return view('dashboard.index', [
            'rooms' => $viewModel->getRoomsData()
        ]);
    }
}
