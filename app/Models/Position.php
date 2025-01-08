<?php

namespace App\Models;

use App\Helpers\UuidHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'keyword',
        'level',
        'all_departments',
        'isHeadOfDepartment',
        'workPeriods',
        'employeeClassification',
        'wageInformation',
        'insuranceType',
        'budgetCode',
        'contractType',
        'compensationRegion',
        'ref',
        'description',
        'role_id',
        'is_public',
        'company_id',
        'created_by_id'
    ];

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'departments_positions', 'position_id', 'department_id');
    }

    public function created_by()
    {
        return $this->belongsTo(Employee::class, 'created_by_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'position_id');
    }

    protected $keyType = 'string';
    public $incrementing = false;

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
