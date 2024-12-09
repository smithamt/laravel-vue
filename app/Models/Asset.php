<?php

namespace App\Models;

use App\Helpers\UuidHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'assets';

    protected $fillable = [
        'id',
        'name',
        'keyword',
        'type',
        'forAll',
        'amount',
        'currencyId',
        'ref',
        'condition',
        'lifecycle',
        'purchaseDate',
        'depreciation',
        'description',
        'maintenanceSchedule',
        'assetPerformance',
        'auditInformation',
        'departmentId',
        'isPublic',
        'createdById',
        'companyId'
    ];

    protected $casts = [
        'id' => 'string',
        'forAll' => 'boolean',
        'isPublic' => 'boolean',
        'purchaseDate' => 'datetime',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currencyId');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'departmentId');
    }

    public function createdBy()
    {
        return $this->belongsTo(Employee::class, 'createdById');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'asset_department', 'assetId', 'departmentId')->as('departments');
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
