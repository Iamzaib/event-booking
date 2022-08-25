<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventBooking extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'event_bookings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'booking_details',
        'booking_event_id',
        'booking_by_user_id',
        'booking_total',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function booking_event()
    {
        return $this->belongsTo(Event::class, 'booking_event_id');
    }

    public function booking_by_user()
    {
        return $this->belongsTo(User::class, 'booking_by_user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
