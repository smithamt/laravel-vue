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
        'currency_id',
        'ref',
        'condition',
        'lifecycle',
        'purchaseDate',
        'depreciation',
        'description',
        'maintenanceSchedule',
        'assetPerformance',
        'auditInformation',
        'department_id',
        'isPublic',
        'created_by_id',
        'company_id'
    ];

    protected $casts = [
        'id' => 'string',
        'forAll' => 'boolean',
        'isPublic' => 'boolean',
        'purchaseDate' => 'datetime',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function created_by()
    {
        return $this->belongsTo(Employee::class, 'created_by_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'asset_department', 'assetId', 'department_id')->as('departments');
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
