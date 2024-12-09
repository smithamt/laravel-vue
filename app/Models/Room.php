<?php

namespace App\Models;

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
        'createdById'
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

    public function createdBy()
    {
        return $this->belongsTo(Employee::class, 'createdById');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }
}
