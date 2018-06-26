<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceCategory extends Model
{
    public function curves()
    {
        return $this->hasMany(DeviceCategoryCurve::class, 'category_id');
    }
}
