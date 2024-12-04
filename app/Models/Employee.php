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
    protected $fillable = ['name', 'nickname', 'employeeId', 'email', 'username', 'password', 'positionId', 'departmentId', 'branchId', 'nationalityId', 'salary', 'salaryType', 'currencyId', 'roleId', 'gender', 'maritalStatusId', 'levelOfEducationId', 'ethnicGroupId', 'height', 'weight', 'contactNo', 'passportNo', 'idCardNo', 'emergencyContact', 'emergencyCall', 'channels', 'languageId', 'degreeOfVision', 'hearingLevel', 'currentAddress', 'permanentAddress'];

    // Optionally, you can also hash the password before saving
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

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
