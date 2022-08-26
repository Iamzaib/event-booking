<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'testimonials';

    protected $dates = [
        'review_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'review_text',
        'ratings',
        'user_id',
        'event_trip_booking_id',
        'review_date',
        'featured',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event_trip_booking()
    {
        return $this->belongsTo(EventBooking::class, 'event_trip_booking_id');
    }

    public function getReviewDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setReviewDateAttribute($value)
    {
        $this->attributes['review_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
