<?php

namespace App\ViewModels;

use App\Models\Reservation;
use Illuminate\Support\Collection;

class BookingViewModel
{
    /**
     * Generate 8 slots and mark them as tersedia or terpakai based on bookings and routine schedules
     */
    public static function generateTimeSlots(Collection $bookings, Collection $routineSchedules = null): array
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

            // 1. Check routine schedule overlap first
            if ($routineSchedules) {
                foreach ($routineSchedules as $schedule) {
                    $scheduleStart = strtotime($schedule->start_time);
                    $scheduleEnd = strtotime($schedule->end_time);

                    if ($slotStartTime < $scheduleEnd && $slotEndTime > $scheduleStart) {
                        $status = 'terpakai';
                        $matchingBooking = [
                            'nama' => $schedule->lecturer_name ?? 'BAAK Akademik',
                            'nim' => '-',
                            'prodi_fakultas' => $schedule->prodi ? $schedule->prodi . ' / ' . $schedule->room->faculty : 'Fakultas ' . $schedule->room->faculty,
                            'whatsapp' => '', // Hide WA button
                            'perihal' => $schedule->type === 'fixed_class' ? 'Perkuliahan' : 'Kegiatan Kampus',
                            'matakuliah' => $schedule->type === 'fixed_class' ? $schedule->title : null,
                            'dosen' => $schedule->lecturer_name,
                            'nama_kegiatan' => $schedule->type === 'general' ? $schedule->title : null,
                            'waktu_mulai' => substr($schedule->start_time, 0, 5),
                            'waktu_selesai' => substr($schedule->end_time, 0, 5),
                            'status_booking' => 'disetujui'
                        ];
                        break; // Found routine overlap
                    }
                }
            }

            // 2. If no routine schedule overlap, check active student reservations
            if ($status === 'tersedia') {
                foreach ($bookings as $booking) {
                    $bookingStart = strtotime($booking->waktu_mulai);
                    $bookingEnd = strtotime($booking->waktu_selesai);

                    // Check overlap
                    if ($slotStartTime < $bookingEnd && $slotEndTime > $bookingStart) {
                        $status = $booking->status === 'menunggu' ? 'diproses' : 'terpakai';
                        $matchingBooking = [
                            'nama' => $booking->nama,
                            'nim' => $booking->nim,
                            'prodi_fakultas' => $booking->prodi_fakultas,
                            'whatsapp' => $booking->whatsapp,
                            'perihal' => $booking->perihal,
                            'matakuliah' => $booking->matakuliah,
                            'dosen' => $booking->dosen,
                            'nama_kegiatan' => $booking->nama_kegiatan,
                            'waktu_mulai' => substr($booking->waktu_mulai, 0, 5),
                            'waktu_selesai' => substr($booking->waktu_selesai, 0, 5),
                            'status_booking' => $booking->status
                        ];
                        break; // Found reservation overlap
                    }
                }
            }

            $slots[] = [
                'time' => $timeStr,
                'time_range' => $timeStr . ' - ' . date('H:i', $slotEndTime),
                'status' => $status,
                'booking' => $matchingBooking
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
