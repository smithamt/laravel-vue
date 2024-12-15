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
        'currency_id',
        'ref',
        'isPublic',
        'company_id',
        'created_by_id'
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

    public function created_by()
    {
        return $this->belongsTo(Employee::class, 'created_by_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
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
