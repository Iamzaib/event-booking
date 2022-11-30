<?php

namespace App\Models;

use Carbon\Carbon;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventBooking extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        'active'          => 'Active',
        'pending-payment' => 'Pending Payment',
        'cancelled'       => 'Cancelled',
    ];

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
        'status',
        'room_id',
        'room_price',
        'booking_from',
        'booking_to',
        'order_payment_type',
        'billing_name',
        'billing_lastname',
        'billing_address',
        'billing_address_2',
        'billing_country_id',
        'billing_state_id',
        'billing_city_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function booking_event()
    {
        return $this->belongsTo(Event::class, 'booking_event_id');
    }
    public function booking_room()
    {
        return $this->belongsTo(HotelRoom::class, 'room_id');
    }
    public function booking_rooms()
    {
        return $this->hasMany(BookingRoom::class,'booking_for_id');
    }
    public function booking_reviews()
    {
        return $this->hasMany(Testimonial::class,'event_trip_booking_id');
    }
    public function travelers()
    {
        return $this->hasMany(Traveler::class,'booking_id');
    }
    public function booking_payment()
    {
        return $this->hasOne(Payment::class,'payment_booking_id','id');
    }
    public function booking_event_addons()
    {
        return $this->belongsToMany(EventAddon::class, 'event_booking_addons','event_booking_id','addon_id')->withPivot('addon_price');
    }
    public function booking_event_costumes()
    {
        return $this->belongsToMany(Costume::class, 'event_booking_costumes','event_booking_id','costume_id')->withPivot('costume_price');
    }
    public function booking_costumes_attributes()
    {
        return $this->hasMany(CostumeBookingAttribute::class);
    }
    public function booking_by_user()
    {
        return $this->belongsTo(User::class, 'booking_by_user_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'billing_city_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'billing_state_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'billing_country_id');
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
    public function delete()
    {
        $this->booking_payment()->delete();
        $this->booking_rooms()->delete();
        $this->travelers()->delete();
        return parent::delete();
    }
}
