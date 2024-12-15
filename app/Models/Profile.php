<?php

namespace App\Models;

use App\Helpers\UuidHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'image_id',
        'description',
        'is_public',
    ];

    protected $casts = [
        'id' => 'string',
        'image_id' => 'string',
        'is_public' => 'boolean',
    ];

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function leaveProfile()
    {
        return $this->belongsTo(Leave::class, 'id');
    }

    public function assetProfile()
    {
        return $this->belongsTo(Asset::class, 'id');
    }

    public function allowanceProfile()
    {
        return $this->belongsTo(Allowance::class, 'id');
    }

    public function deductionProfile()
    {
        return $this->belongsTo(Deduction::class, 'id');
    }

    public function positionProfile()
    {
        return $this->belongsTo(Position::class, 'id');
    }

    public function branchProfile()
    {
        return $this->belongsTo(Branch::class, 'id');
    }

    public function departmentProfile()
    {
        return $this->belongsTo(Department::class, 'id');
    }

    public function holidayProfile()
    {
        return $this->belongsTo(Holiday::class, 'id');
    }

    public function employeeProfile()
    {
        return $this->belongsTo(Employee::class, 'id');
    }

    public function companyProfile()
    {
        return $this->belongsTo(Company::class, 'id');
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
