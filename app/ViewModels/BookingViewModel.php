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
            '08:00', '08:50', '09:40', '10:30', '11:20', '12:10',
            '13:00', '13:50', '14:40', '15:30', '16:20', '17:10'
        ];

        $slots = [];

        foreach ($defaultSlots as $timeStr) {
            if ($timeStr === '12:10') {
                $slots[] = [
                    'time' => $timeStr,
                    'time_range' => '12:10 - 13:00',
                    'status' => 'istirahat',
                    'booking' => null
                ];
                continue;
            }

            $slotStartTime = strtotime($timeStr);
            $slotEndTime = strtotime("+50 minutes", $slotStartTime); // Each slot is 50 minutes (1 SKS)
            
            $status = 'tersedia';
            $matchingBooking = null;

            foreach ($bookings as $booking) {
                $bookingStart = strtotime($booking->waktu_mulai);
                $bookingEnd = strtotime($booking->waktu_selesai);

                // Check overlap
                if ($slotStartTime < $bookingEnd && $slotEndTime > $bookingStart) {
                    $status = $booking->status === 'menunggu' ? 'diproses' : 'terpakai';
                    $matchingBooking = $booking;
                    break;
                }
            }

            $slots[] = [
                'time' => $timeStr,
                'time_range' => $timeStr . ' - ' . date('H:i', $slotEndTime),
                'status' => $status,
                'booking' => $matchingBooking ? [
                    'nama' => $matchingBooking->nama,
                    'nim' => $matchingBooking->nim,
                    'prodi_fakultas' => $matchingBooking->prodi_fakultas,
                    'whatsapp' => $matchingBooking->whatsapp,
                    'perihal' => $matchingBooking->perihal,
                    'matakuliah' => $matchingBooking->matakuliah,
                    'dosen' => $matchingBooking->dosen,
                    'nama_kegiatan' => $matchingBooking->nama_kegiatan,
                    'waktu_mulai' => substr($matchingBooking->waktu_mulai, 0, 5),
                    'waktu_selesai' => substr($matchingBooking->waktu_selesai, 0, 5),
                    'status_booking' => $matchingBooking->status
                ] : null
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
