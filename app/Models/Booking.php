<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'booking';
    public $timestamps = false;

    public static function hasAvailability($roomTypeId, $start, $end, $excludeBookingId = null)
    {
        $totalRooms = DB::table('room')
            ->where('roomtype_id', $roomTypeId)
            ->whereNotIn('status', [4, 5])
            ->count();

        if ($totalRooms <= 0) {
            return false;
        }

        $query = DB::table('booking')
            ->where('room_type_id', $roomTypeId)
            ->whereIn('booking_status', [0, 1, 2])
            ->where('time_start', '<', $end)
            ->where('time_end', '>', $start);

        if ($excludeBookingId) {
            $query->where('id', '<>', $excludeBookingId);
        }

        $bookedCount = $query->count();
        return $bookedCount < $totalRooms;
    }
}
