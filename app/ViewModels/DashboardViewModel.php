<?php

namespace App\ViewModels;

use Illuminate\Support\Collection;

class DashboardViewModel
{
    public static function formatRooms(Collection $rooms): Collection
    {
        return $rooms->map(function ($room) {
            $status = $room->status;

            $data_status = match ($status) {
                'available' => 'tersedia',
                'occupied' => 'terpakai',
                default => 'nonaktif',
            };

            // Calculate data_type early from the building column
            $data_type = $room->building ?? 'kelas';

            $type_label = match ($data_type) {
                'lab' => 'Laboratorium',
                'aula' => 'Aula',
                'theater' => 'Theater',
                default => 'Ruang kelas',
            };

            // Dynamic styling based ALWAYS on category (for consistent visual identification, available or not)
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

            // Status Badge Colors
            $badge_text_color = match ($status) {
                'available' => match ($data_type) {
                    'lab' => 'text-emerald-600',
                    'aula' => 'text-amber-600',
                    'theater' => 'text-purple-600',
                    default => 'text-blue-600',
                },
                'occupied' => 'text-rose-600',
                default => 'text-slate-500',
            };

            $badge_text = match ($status) {
                'available' => 'Tersedia',
                'occupied' => 'Terpakai',
                default => 'Nonaktif',
            };

            // Buttons styled specifically for each category (consistent prominent style)
            $button_class = match ($data_type) {
                'lab' => 'bg-white hover:bg-slate-50 text-emerald-700',
                'aula' => 'bg-white hover:bg-slate-50 text-amber-700',
                'theater' => 'bg-white hover:bg-slate-50 text-purple-700',
                default => 'bg-white hover:bg-slate-50 text-blue-700',
            };

            $button_text = 'Lihat Jadwal';

            $category_badge_class = match ($data_type) {
                'lab' => 'bg-emerald-600 text-white',
                'aula' => 'bg-amber-500 text-slate-900',
                'theater' => 'bg-purple-600 text-white',
                default => 'bg-blue-600 text-white',
            };

            $location_label = $room->campus;

            $image_url = match ($data_type) {
                'lab' => asset('images/lab.jpg'),
                'aula' => asset('images/aula.jpg'),
                'theater' => asset('images/theater.jpg'),
                default => asset('images/kelas.jpg'),
            };

            return (object) [
                'id' => $room->id,
                'name' => $room->name,
                'data_name' => strtolower($room->name),
                'campus' => $room->campus,
                'faculty' => $room->faculty,
                'data_faculty' => strtolower($room->faculty),
                'building' => $room->building ?? 'kelas',
                'data_building' => $room->building ?? 'kelas',
                'data_type' => $data_type,
                'type_label' => $type_label,
                'category_badge_class' => $category_badge_class,
                'location_label' => $location_label,
                'capacity' => $room->capacity,
                'data_status' => $data_status,
                'image_bg_gradient' => $image_bg_gradient,
                'content_bg_color' => $content_bg_color,
                'badge_text' => $badge_text,
                'badge_text_color' => $badge_text_color,
                'button_url' => '/rooms/'.$room->id,
                'button_class' => $button_class,
                'button_text' => $button_text,
                'subtext_class' => $subtext_class,
                'image_url' => $image_url,
            ];
        });
    }
}
