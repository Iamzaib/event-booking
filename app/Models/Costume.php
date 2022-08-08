<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Costume extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_RADIO = [
        '1' => 'Enable',
        '0' => 'Disable',
    ];

    public $table = 'costumes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'costume_title',
        'costume_details',
        'costume_price',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function options()
    {
        return $this->belongsToMany(CostumeAttribute::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
