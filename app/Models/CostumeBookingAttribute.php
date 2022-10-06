<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostumeBookingAttribute extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'costume_booking_attributes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'booking_id',
        'traveler_id',
        'costume_id',
        'costume_attribute_id',
        'values',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function costume()
    {
        return $this->belongsTo(Costume::class,'costume_id');
    }
    public function costumeAttribute()
    {
        return $this->belongsTo(CostumeAttribute::class,'costume_attribute_id');
    }
    public function booking()
    {
        return $this->belongsTo(EventBooking::class,'booking_id');
    }
    public function traveler()
    {
        return $this->belongsTo(Traveler::class,'traveler_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
