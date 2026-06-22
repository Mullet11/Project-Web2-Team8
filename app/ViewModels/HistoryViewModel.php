<?php

namespace App\ViewModels;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class HistoryViewModel
{
    /**
     * Format list of reservations for history index page
     */
    public static function formatIndex(Collection $reservations): array
    {
        return $reservations->map(function ($res) {
            $room = $res->room;
            $data_type = $room->building ?? 'kelas';

            $type_label = match ($data_type) {
                'lab' => 'Laboratorium',
                'aula' => 'Aula',
                'theater' => 'Theater',
                default => 'Ruang kelas',
            };

            $content_bg_color = match ($data_type) {
                'lab' => 'bg-emerald-900',
                'aula' => 'bg-amber-900',
                'theater' => 'bg-purple-900',
                default => 'bg-blue-900',
            };

            $subtext_class = match ($data_type) {
                'lab' => 'text-emerald-100/80',
                'aula' => 'text-amber-100/80',
                'theater' => 'text-purple-100/80',
                default => 'text-blue-100/80',
            };

            $image_bg_gradient = match ($data_type) {
                'lab' => 'from-emerald-500/10 via-teal-500/5 to-cyan-500/10',
                'aula' => 'from-amber-500/10 via-orange-500/5 to-yellow-500/10',
                'theater' => 'from-purple-500/10 via-fuchsia-500/5 to-pink-500/10',
                default => 'from-blue-500/10 via-sky-500/5 to-cyan-500/10',
            };

            $category_badge_class = match ($data_type) {
                'lab' => 'bg-emerald-600 text-white',
                'aula' => 'bg-amber-500 text-slate-900',
                'theater' => 'bg-purple-600 text-white',
                default => 'bg-blue-600 text-white',
            };

            $button_class = match ($data_type) {
                'lab' => 'bg-white hover:bg-slate-50 text-emerald-700',
                'aula' => 'bg-white hover:bg-slate-50 text-amber-700',
                'theater' => 'bg-white hover:bg-slate-50 text-purple-700',
                default => 'bg-white hover:bg-slate-50 text-blue-700',
            };

            $image_url = match ($data_type) {
                'lab' => asset('images/lab.jpg'),
                'aula' => asset('images/aula.jpg'),
                'theater' => asset('images/theater.jpg'),
                default => asset('images/kelas.jpg'),
            };

            $status_theme = self::getThemeForStatus($res->status);

            return [
                'id' => $res->id,
                'status' => $res->status,
                'status_label' => ucfirst($res->status),
                'room_name' => $room->name,
                'campus' => $room->campus,
                'faculty' => $room->faculty,
                'capacity' => $room->capacity,
                'tanggal' => Carbon::parse($res->tanggal)->translatedFormat('l, d F'),
                'waktu' => substr($res->waktu_mulai, 0, 5).' - '.substr($res->waktu_selesai, 0, 5).' WIB',
                'type_label' => $type_label,
                'content_bg_color' => $content_bg_color,
                'subtext_class' => $subtext_class,
                'image_bg_gradient' => $image_bg_gradient,
                'category_badge_class' => $category_badge_class,
                'button_class' => $button_class,
                'image_url' => $image_url,
                'badge_text_color' => $status_theme['badge_text'],
            ];
        })->toArray();
    }

    /**
     * Format a single reservation for viewDetailHistory or editDetailHistory
     */
    public static function formatDetail(Reservation $reservation): array
    {
        $room = $reservation->room;
        $data_type = $room->building ?? 'kelas';
        $image_url = match ($data_type) {
            'lab' => asset('images/lab.jpg'),
            'aula' => asset('images/aula.jpg'),
            'theater' => asset('images/theater.jpg'),
            default => asset('images/kelas.jpg'),
        };

        return [
            'id' => $reservation->id,
            'status' => $reservation->status,
            'room_name' => $room->name,
            'campus' => $room->campus,
            'capacity' => $room->capacity,
            'type' => $room->facilities ?? 'Ruang Kelas',
            'nama' => $reservation->nama,
            'nim' => $reservation->nim,
            'prodi_fakultas' => $reservation->prodi_fakultas,
            'whatsapp' => $reservation->whatsapp,
            'perihal' => $reservation->perihal,
            'nama_kegiatan' => $reservation->nama_kegiatan,
            'tanggal' => Carbon::parse($reservation->tanggal)->translatedFormat('l, d F Y'),
            'tanggal_raw' => $reservation->tanggal,
            'waktu' => substr($reservation->waktu_mulai, 0, 5).' - '.substr($reservation->waktu_selesai, 0, 5).' WIB',
            'waktu_mulai' => substr($reservation->waktu_mulai, 0, 5),
            'waktu_selesai' => substr($reservation->waktu_selesai, 0, 5),
            'no_booking' => $reservation->no_booking,
            'dosen' => $reservation->dosen,
            'matakuliah' => $reservation->matakuliah,
            'alasan_batal' => $reservation->alasan_batal,
            'image_url' => $image_url,
        ];
    }

    private static function getThemeForStatus($status)
    {
        // Based on Naufal's index.blade.php
        if ($status === 'disetujui') {
            return [
                'bg_bottom' => 'bg-blue-600',
                'text_bottom' => 'text-blue-100/90',
                'badge_text' => 'text-blue-600',
                'btn_class' => 'bg-white hover:bg-slate-50 text-blue-600',
                // Naufal's Disetujui SVG Illustration
                'svg' => '<svg viewBox="0 0 200 120" class="w-full h-full max-h-36 object-contain" xmlns="http://www.w3.org/2000/svg">
                            <rect x="20" y="90" width="160" height="6" rx="3" fill="#e2e8f0" />
                            <rect x="55" y="20" width="90" height="55" rx="4" fill="#cbd5e1" />
                            <rect x="59" y="24" width="82" height="47" rx="2" fill="#3b82f6" />
                            <rect x="96" y="75" width="8" height="15" fill="#94a3b8" />
                            <polygon points="85,90 100,75 115,90" fill="#64748b" />
                            <rect x="25" y="35" width="22" height="16" rx="3" fill="#38bdf8" />
                            <path d="M30 43 h12 M30 47 h8" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M65 60 l15-15 l10,10 l25-25" fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round" />
                            <circle cx="115" cy="30" r="3" fill="#facc15" />
                        </svg>',
            ];
        } elseif ($status === 'selesai') {
            return [
                'bg_bottom' => 'bg-brand-primary', // assumed to be teal-like in Naufal's css
                'text_bottom' => 'text-teal-100/90',
                'badge_text' => 'text-emerald-600',
                'btn_class' => 'bg-white hover:bg-slate-50 text-brand-primary',
                // Naufal's Selesai SVG
                'svg' => '<svg viewBox="0 0 200 120" class="w-full h-full max-h-36 object-contain" xmlns="http://www.w3.org/2000/svg">
                            <rect x="25" y="90" width="150" height="6" rx="3" fill="#e2e8f0" />
                            <rect x="65" y="45" width="70" height="42" rx="4" fill="#64748b" />
                            <rect x="69" y="49" width="62" height="34" rx="2" fill="#0d9488" />
                            <rect x="60" y="86" width="80" height="4" rx="2" fill="#475569" />
                            <rect x="30" y="30" width="24" height="16" rx="2" fill="#06b6d4" />
                            <polygon points="30,32 42,40 54,32" fill="#ffffff" opacity="0.9" />
                            <rect x="80" y="55" width="10" height="20" fill="#ffffff" opacity="0.8" />
                            <rect x="95" y="60" width="10" height="15" fill="#ffffff" opacity="0.8" />
                            <rect x="110" y="65" width="10" height="10" fill="#ffffff" opacity="0.8" />
                        </svg>',
            ];
        } elseif ($status === 'dibatalkan') {
            return [
                'bg_bottom' => 'bg-rose-600',
                'text_bottom' => 'text-rose-100/90',
                'badge_text' => 'text-rose-600',
                'btn_class' => 'bg-white hover:bg-slate-50 text-rose-600',
                // Naufal's Dibatalkan SVG
                'svg' => '<svg viewBox="0 0 200 120" class="w-full h-full max-h-36 object-contain" xmlns="http://www.w3.org/2000/svg">
                            <rect x="20" y="90" width="160" height="6" rx="3" fill="#e2e8f0" />
                            <rect x="70" y="30" width="60" height="50" rx="6" fill="#cbd5e1" />
                            <rect x="70" y="30" width="60" height="12" fill="#f43f5e" rx="3" />
                            <circle cx="80" cy="52" r="3" fill="#94a3b8" />
                            <circle cx="95" cy="52" r="3" fill="#94a3b8" />
                            <circle cx="110" cy="52" r="3" fill="#94a3b8" />
                            <circle cx="80" cy="67" r="3" fill="#94a3b8" />
                            <circle cx="95" cy="67" r="3" fill="#f43f5e" />
                            <circle cx="110" cy="67" r="3" fill="#94a3b8" />
                            <circle cx="140" cy="45" r="16" fill="#ef4444" opacity="0.9" />
                            <path d="M133 38 l14 14 M147 38 l-14 14" stroke="#ffffff" stroke-width="3" stroke-linecap="round" />
                        </svg>',
            ];
        } else {
            // Menunggu
            return [
                'bg_bottom' => 'bg-slate-500',
                'text_bottom' => 'text-slate-100/90',
                'badge_text' => 'text-slate-600',
                'btn_class' => 'bg-white hover:bg-slate-50 text-slate-600',
                // Naufal's Menunggu SVG
                'svg' => '<svg viewBox="0 0 200 120" class="w-full h-full max-h-36 object-contain" xmlns="http://www.w3.org/2000/svg">
                            <rect x="20" y="90" width="160" height="6" rx="3" fill="#e2e8f0" />
                            <circle cx="100" cy="50" r="30" fill="#cbd5e1" />
                            <circle cx="100" cy="50" r="26" fill="#f8fafc" />
                            <path d="M100 32 v18 h12" fill="none" stroke="#94a3b8" stroke-width="4" stroke-linecap="round" />
                            <circle cx="128" cy="28" r="11" fill="#64748b" />
                            <path d="M125 24 v5 h6" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" />
                        </svg>',
            ];
        }
    }
}
