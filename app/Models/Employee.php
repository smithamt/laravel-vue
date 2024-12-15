<?php

namespace App\Models;

use App\Helpers\UuidHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'nickname',
        'employee_id',
        'date_of_birth',
        'nationality_id',
        'position_id',
        'joined_date',
        'probation_month',
        'fingerprintId',
        'username',
        'password',
        'department_id',
        'branch_id',
        'scheduleId',
        'email',
        'contact_no',
        'telegram',
        'gender',
        'idCardNo',
        'role',
        'ref',
        'state',
        'is_public',
        'company_id',
        'created_by_id',
        'created_at',
        'updated_at',
        'employee_type_id',
        'last_promotion_date',
        'language',
        'room_id'
    ];

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

    public function profile()
    {
        return $this->hasOne(Profile::class, 'image_id');
    }

    public function appraisals()
    {
        return $this->hasMany(Appraisal::class, 'employee_id');
    }

    public function createdAppraisals()
    {
        return $this->hasMany(Appraisal::class, 'created_by_id');
    }

    public function approvedAppraisals()
    {
        return $this->hasMany(Appraisal::class, 'approvedById');
    }

    public function reviewedAppraisals()
    {
        return $this->hasMany(Appraisal::class, 'reviewedById');
    }
}
