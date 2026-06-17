<?php

namespace App\Application\Dashboard;

use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;

class GetDashboardData
{
    /**
     * Mengambil daftar ruangan untuk dashboard
     * 
     * @return Collection
     */
    public function execute(): Collection
    {
        // Untuk tahap awal, kita ambil semua ruangan.
        // Nanti bisa diurutkan atau difilter (misal hanya yang 'active' / 'available').
        return Room::all();
    }
}
