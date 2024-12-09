<?php

namespace App\Models;

use App\Helpers\UuidHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpSession extends Model
{
    use HasFactory;
    protected $table = 'emp_sessions';
    protected $fillable = ['payload', 'user_id', 'ip_address', 'user_agent', 'last_activity', 'session_id',];

    protected $keyType = 'string';
    public $incrementing = false;



    // Automatically generate a UUID for the primary key
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = UuidHelper::generateObjectId();
            }
        });
    }
}
