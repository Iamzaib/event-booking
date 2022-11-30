<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TripDateRange extends Model
{

    public $table = 'event_trip_date_ranges';

    protected $dates = [
        'range_start',
        'range_end',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'event_id',
        'range_start',
        'range_end',
        'range_title',
        'range_price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function event_trip(){
        $this->belongsTo(Event::class);
    }

}
