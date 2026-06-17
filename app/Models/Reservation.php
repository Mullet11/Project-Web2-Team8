<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'booking_code', 'user_id', 'room_id', 'title', 'purpose', 
        'reservation_date', 'start_time', 'end_time', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
