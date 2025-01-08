<?php

namespace App\Models;

use App\Helpers\UuidHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRoom extends Model
{
    use HasFactory;

    protected $table = 'employee_rooms';

    protected $fillable = [
        'id',
        'room_id',
        'starting_date',
        'created_by_id',
        'is_public',
    ];

    protected $casts = [
        'id' => 'string',
        'room_id' => 'string',
        'starting_date' => 'date',
        'is_public' => 'boolean',
    ];

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
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
