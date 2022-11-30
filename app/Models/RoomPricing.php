<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RoomPricing extends Model
{
    use HasFactory;

    public $table = 'room_pricing';

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'room_pricing_range_id',
        'room_id',
        'price',
        'for_travelers',
        'created_at',
        'updated_at',

    ];

    public function ranges()
    {
        return $this->belongsTo(RoomPricingRange::class, 'room_pricing_ranges_id');
    }
    public function room()
    {
        return $this->belongsTo(HotelRoom::class,'room_id');
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }
    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['ticket_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
    public function setEndDateAttribute($value)
    {
        $this->attributes['ticket_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
