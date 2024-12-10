<?php

namespace App\Models;

use App\Helpers\UuidHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appraisal extends Model
{
    use HasFactory;

    protected $table = 'appraisals';

    protected $fillable = [
        'id',
        'employee_id',
        'status',
        'approvedById',
        'reviewedById',
        'employeeComments',
        'refId',
        'state',
        'isPublic',
        'companyId',
        'department_id',
        'created_by_id'
    ];

    protected $casts = [
        'id' => 'string',
        'isPublic' => 'boolean',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function created_by()
    {
        return $this->belongsTo(Employee::class, 'created_by_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(Employee::class, 'approvedById');
    }

    public function reviewedBy()
    {
        return $this->belongsTo(Employee::class, 'reviewedById');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId');
    }

    public function plans()
    {
        return $this->belongsToMany(DevelopmentPlan::class, 'appraisal_plans', 'appraisalId', 'developmentId')->as('plans');
    }

    public function reviews()
    {
        return $this->belongsToMany(Evaluation::class, 'appraisal_reviews', 'appraisalId', 'evaluationId')->as('reviews');
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
