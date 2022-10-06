<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const PAYMENT_METHOD_RADIO = [
        'CC'    => 'Credit/Debit Card (Stripe)',
        'Other' => 'Other',
    ];

    public $table = 'payments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'payment_event_id',
        'payment_user_id',
        'payment_booking_id',
        'amount_total',
        'starting_total',
        'savings',
        'coupon_amount',
        'coupon_code',
        'processing_fee',
        'subtotal',
        'installment',
        'total_installments',
        'amount_paid',
        'amount_balance',
        'payment_method',
        'payment_details',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function payment_event()
    {
        return $this->belongsTo(Event::class, 'payment_event_id');
    }

    public function installments()
    {
        return $this->hasMany(InstallmentPayments::class);
    }

    public function payment_user()
    {
        return $this->belongsTo(User::class, 'payment_user_id');
    }

    public function payment_booking()
    {
        return $this->belongsTo(EventBooking::class, 'payment_booking_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
