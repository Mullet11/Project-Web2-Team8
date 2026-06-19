<?php

namespace App\ViewModels;

use App\Models\Reservation;
use Illuminate\Support\Collection;

class BookingViewModel
{
    /**
     * Generate 8 slots and mark them as tersedia or terpakai based on bookings
     */
    public static function generateTimeSlots(Collection $bookings): array
    {
        $defaultSlots = [
            '07:30', '09:00', '10:30', '12:00', 
            '13:30', '15:00', '16:30', '18:00'
        ];

        $slots = [];

        foreach ($defaultSlots as $timeStr) {
            $slotStartTime = strtotime($timeStr);
            $slotEndTime = strtotime("+90 minutes", $slotStartTime); // Each slot is 1.5 hours in Naufal's logic
            
            $status = 'tersedia';

            foreach ($bookings as $booking) {
                $bookingStart = strtotime($booking->waktu_mulai);
                $bookingEnd = strtotime($booking->waktu_selesai);

                // Check overlap
                if ($slotStartTime < $bookingEnd && $slotEndTime > $bookingStart) {
                    $status = $booking->status === 'menunggu' ? 'diproses' : 'terpakai';
                    break;
                }
            }

            $slots[] = [
                'time' => $timeStr,
                'status' => $status
            ];
        }

        return $slots;
    }

    /**
     * Format schedules for viewClassUsed view
     */
    public static function formatSchedules(Collection $schedules): array
    {
        return $schedules->map(function ($schedule) {
            // Determine active status: if current time is between start and end, then sedang_berlangsung
            $currentTime = date('H:i:s');
            $statusUI = 'akan_datang';
            
            if ($currentTime >= $schedule->waktu_selesai) {
                $statusUI = 'selesai';
            } elseif ($currentTime >= $schedule->waktu_mulai && $currentTime <= $schedule->waktu_selesai) {
                $statusUI = 'sedang_berlangsung';
            }

            return [
                'time' => substr($schedule->waktu_mulai, 0, 5) . ' - ' . substr($schedule->waktu_selesai, 0, 5),
                'type' => $schedule->perihal,
                'subject' => $schedule->matakuliah ?? $schedule->nama_kegiatan,
                'activity' => $schedule->nama_kegiatan,
                'lecturer' => $schedule->dosen,
                'pic' => $schedule->nama, // PIC is the one who booked
                'class' => $schedule->prodi_fakultas, // Mapping prodi to class since we don't have class column
                'whatsapp' => $schedule->whatsapp,
                'status' => $statusUI
            ];
        })->toArray();
    }
}
