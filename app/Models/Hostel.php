<?php

namespace App\Models;

use App\Helpers\UuidHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    use HasFactory;

    protected $table = 'hostels';

    protected $fillable = [
        'id',
        'name',
        'address',
        'capacity',
        'companyId',
        'createdById'
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId');
    }

    public function createdBy()
    {
        return $this->belongsTo(Employee::class, 'createdById');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'hostelId');
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
