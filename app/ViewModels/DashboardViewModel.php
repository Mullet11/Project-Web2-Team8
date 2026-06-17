<?php

namespace App\ViewModels;

use Illuminate\Database\Eloquent\Collection;

class DashboardViewModel
{
    public function __construct(
        public readonly Collection $rooms
    ) {}

    /**
     * Jika kita perlu melakukan mapping data sebelum dikirim ke view,
     * kita bisa melakukannya di sini.
     */
    public function getRoomsData()
    {
        return $this->rooms->map(function ($room) {
            return [
                'id' => $room->id,
                'name' => $room->name,
                'building' => $room->building,
                'capacity' => $room->capacity,
                'status' => $room->status,
                // tambahkan badge warna otomatis untuk status
                'status_color' => match($room->status) {
                    'available' => 'green',
                    'occupied' => 'red',
                    'inactive' => 'gray',
                    default => 'gray',
                }
            ];
        });
    }
}
