<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstallmentPayments extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'installment_payments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'payment_id',
        'amount_total',
        'amount_paid',
        'amount_balance',
        'installment',
        'total_installments',
        'installment_no',
        'payment_method',
        'payment_details',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
