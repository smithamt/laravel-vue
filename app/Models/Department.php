<?php

namespace App\Models;

use App\Helpers\UuidHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'keyword',
        'description',
        'allowHalfOff',
        'rolesAndResponsibilities',
        'budget',
        'goals',
        'policies',
        'ref',
        'is_public',
        'company_id',
        'created_by_id'
    ];

    // Relationships

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class, 'departments_positions', 'department_id', 'position_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(Employee::class, 'created_by_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

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
