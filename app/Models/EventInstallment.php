<?php

namespace App\Models;

use Carbon\Carbon;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventInstallment extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'installment_events';

    protected $dates = [
        'due_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'event_id',
        'installment',
        'due_date',
        'installment_no',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function trip()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
    public function getDueDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }
    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
