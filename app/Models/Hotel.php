<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'hotels';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'hotel_name',
        'details',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }
    public function rooms()
    {
        return $this->hasMany(HotelRoom::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
