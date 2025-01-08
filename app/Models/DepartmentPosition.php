<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DepartmentPosition extends Pivot
{
    protected $table = 'departments_positions';
}
