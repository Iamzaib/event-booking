<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Traveler extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const GENDER_RADIO = [
        'male'   => 'Male',
        'female' => 'Female',
    ];

    public $table = 'travelers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'booking_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'gender',
        'shirt_size',
        'notes',
        'costume_id',
        'room_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function booking()
    {
        return $this->belongsTo(EventBooking::class, 'booking_id');
    }

    public function costume()
    {
        return $this->belongsTo(Costume::class, 'costume_id');
    }
    public function costume_attr()
    {
        return $this->hasMany(CostumeBookingAttribute::class);
    }

    public function tickets()
    {
        return $this->belongsToMany(EventTicket::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
