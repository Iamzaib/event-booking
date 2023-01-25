<?php

namespace App\Models;

use Carbon\Carbon;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const COUPONS_TYPE_RADIO = [
        'Percent'    => 'Discount Percentage',
        'Amount' => 'Discount Amount',
    ];
    public $table = 'coupons';

    protected $dates = [
        'expiry',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'code',
        'type',
        'value',
        'minimum_amount',
        'expiry',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function getExpiryAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setExpiryAttribute($value)
    {
        $this->attributes['expiry'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
