<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingRoom extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'booking_rooms';

    protected $dates = [
        'booking_from',
        'booking_to',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'room_id',
        'booking_for_id',
        'room_booking_rate',
        'booking_from',
        'booking_to',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function room()
    {
        return $this->belongsTo(HotelRoom::class, 'room_id');
    }

    public function booking_for()
    {
        return $this->belongsTo(EventBooking::class, 'booking_for_id');
    }

    public function getBookingFromAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBookingFromAttribute($value)
    {
        $this->attributes['booking_from'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getBookingToAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBookingToAttribute($value)
    {
        $this->attributes['booking_to'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
