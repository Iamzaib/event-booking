<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'events';

    protected $appends = [
        'featured_image',
    ];

    protected $dates = [
        'event_start',
        'event_end',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'event_title',
        'overview',
        'duration',
        'age',
        'daily_price',
        'information',
        'country_id',
        'state_id',
        'city_id',
        'event_start',
        'event_end',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function boot()
    {
        parent::boot();
        Event::observe(new \App\Observers\EventActionObserver());
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function bookingEventEventBookings()
    {
        return $this->hasMany(EventBooking::class, 'booking_event_id', 'id');
    }

    public function getFeaturedImageAttribute()
    {
        $file = $this->getMedia('featured_image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function getEventStartAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEventStartAttribute($value)
    {
        $this->attributes['event_start'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEventEndAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEventEndAttribute($value)
    {
        $this->attributes['event_end'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class);
    }
    public function room_pricing()
    {
        return $this->hasMany(RoomPricingRange::class);
    }

    public function itinerary()
    {
        return $this->hasMany(Itinerary::class);
    }
    public function date_ranges()
    {
        return $this->hasMany(TripDateRange::class);
    }
    public function reviews()
    {
        return $this->hasManyThrough(Testimonial::class,EventBooking::class,'id','event_trip_booking_id');
    }
    public function avgRating()
    {
        return $this->reviews->avg('ratings');
    }
    public function tickets()
    {
        return $this->hasMany(EventTicket::class);
    }
    public function faqs()
    {
        return $this->hasMany(EventFaq::class);
    }

    public function addons()
    {
        return $this->belongsToMany(EventAddon::class);
    }

    public function amenities_includeds()
    {
        return $this->belongsToMany(PackageAmenity::class);
    }
    public function amenities_excludeds()
    {
        return $this->belongsToMany(PackageAmenity::class,'event_package_amenity_excluded');
    }
    public function costumes()
    {
        return $this->belongsToMany(Costume::class,'event_costumes');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
