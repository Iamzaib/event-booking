<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingAddon extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'booking_addons';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'addon_id',
        'event_booking_id',
        'traveler_id',
        'addon_price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function addon(){
        $this->belongsTo(EventAddon::class,'addon_id');
    }
    public function traveler(){
        $this->belongsTo(Traveler::class,'traveler_id');
    }
}
