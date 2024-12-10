<?php

namespace App\Models;

use App\Helpers\UuidHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'id',
        'roomNumber',
        'capacity',
        'hostelId',
        'isOccupied',
        'created_by_id'
    ];

    protected $casts = [
        'id' => 'string',
        'capacity' => 'integer',
        'isOccupied' => 'boolean',
    ];

    public function hostel()
    {
        return $this->belongsTo(Hostel::class, 'hostelId');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'room_id');
    }

    public function created_by()
    {
        return $this->belongsTo(Employee::class, 'created_by_id');
    }

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
