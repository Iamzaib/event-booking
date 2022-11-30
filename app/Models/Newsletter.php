<?php
namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Newsletter extends Model
{

    use HasFactory;

    public $table = 'newsletter';

    protected $dates = [
        'subscribe_date',
        'unsubscribe_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'email',
        'unsubscribe',
        'user_id',
        'subscribe_date',
        'unsubscribe_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
