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

            $image_bg_gradient = match ($status) {
                'available' => 'from-blue-500/10 via-indigo-500/5 to-teal-500/10',
                default => 'from-slate-100 via-slate-50 to-slate-200/50',
            };

            $content_bg_color = match ($status) {
                'available' => 'bg-brand-primary',
                default => 'bg-slate-800',
            };

            $badge_text = match ($status) {
                'available' => 'Tersedia',
                'occupied' => 'Terpakai',
                default => 'Nonaktif',
            };

            $badge_text_color = match ($status) {
                'available' => 'text-emerald-600',
                'occupied' => 'text-rose-600',
                default => 'text-slate-500',
            };

            $button_class = match ($status) {
                'available' => 'bg-white hover:bg-slate-50 text-brand-primary',
                default => 'bg-slate-900/50 hover:bg-slate-900 text-slate-300 hover:text-white border border-slate-700',
            };

            $button_text = match ($status) {
                'available' => 'Booking',
                default => 'Lihat Jadwal',
            };

            $subtext_class = match ($status) {
                'available' => 'text-teal-100/80',
                default => 'text-slate-400',
            };

            $data_building = substr($room->building, -1);

            return (object) [
                'id' => $room->id,
                'name' => $room->name,
                'data_name' => strtolower($room->name),
                'building' => $room->building,
                'data_building' => $data_building,
                'capacity' => $room->capacity,
                'data_status' => $data_status,
                'image_bg_gradient' => $image_bg_gradient,
                'content_bg_color' => $content_bg_color,
                'badge_text' => $badge_text,
                'badge_text_color' => $badge_text_color,
                'button_url' => '/rooms/' . $room->id,
                'button_class' => $button_class,
                'button_text' => $button_text,
                'subtext_class' => $subtext_class,
            ];
        });
    }
}
