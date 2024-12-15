<?php

namespace App\Models;

use App\Helpers\UuidHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeExtend extends Model
{
    use HasFactory;

    protected $table = 'employee_extends';

    protected $fillable = [
        'id',
        'employee_id',
        'original_probation_end_date',
        'extended_probation_end_date',
        'reason',
        'status',
        'approved_by',
        'created_by_id',
    ];

    protected $casts = [
        'id' => 'string',
        'employee_id' => 'string',
        'original_probation_end_date' => 'date',
        'extended_probation_end_date' => 'date',
        'status' => 'string',
        'approved_by' => 'string',
        'created_by_id' => 'string',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function approver()
    {
        return $this->belongsTo(Employee::class, 'approved_by');
    }

    public function creator()
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
