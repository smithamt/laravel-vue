<?php

namespace App\Models;

use App\Helpers\UuidHelper;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';
    protected $fillable = ['id', 'employee_id', 'date', 'leaveId', 'fromModel', 'overtime', 'ref', 'remarkById', 'updatedById', 'scheduleId', 'remark', 'status', 'halfOff', 'checkInId', 'checkOutId', 'isPublic', 'created_by_id'];
    protected $casts = ['id' => 'string', 'date' => 'date', 'overtime' => 'integer', 'isPublic' => 'boolean',];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function created_by()
    {
        return $this->belongsTo(Employee::class, 'created_by_id');
    }
    public function remarkBy()
    {
        return $this->belongsTo(Employee::class, 'remarkById');
    }
    public function updatedBy()
    {
        return $this->belongsTo(Employee::class, 'updatedById');
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'scheduleId');
    }
    public function leave()
    {
        return $this->belongsTo(Leave::class, 'leaveId');
    }
    public function holiday()
    {
        return $this->belongsTo(Holiday::class, 'leaveId');
    }
    public function checkIn()
    {
        return $this->hasOne(CheckIn::class, 'attendanceId');
    }
    public function checkOut()
    {
        return $this->hasOne(CheckOut::class, 'attendanceId');
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
