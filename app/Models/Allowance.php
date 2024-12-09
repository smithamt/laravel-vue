<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Helpers\UuidHelper;
use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    use HasFactory;

    protected $table = 'allowances';

    protected $fillable = [
        'id',
        'name',
        'keyword',
        'description',
        'amount',
        'minimumWorkingDaysPerMonth',
        'frequency',
        'isTaxable',
        'currencyId',
        'ref',
        'isPublic',
        'companyId',
        'createdById'
    ];

    protected $casts = [
        'id' => 'string',
        'amount' => 'float',
        'minimumWorkingDaysPerMonth' => 'integer',
        'isTaxable' => 'boolean',
        'isPublic' => 'boolean',
    ];

    public function color()
    {
        return $this->hasOne(Color::class, 'contentId');
    }

    public function createdBy()
    {
        return $this->belongsTo(Employee::class, 'createdById');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currencyId');
    }

    // Use UUIDs for primary keys
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
