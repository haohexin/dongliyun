<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceCategory extends Model
{
    public function curves()
    {
        return $this->hasMany(DeviceCategoryCurve::class, 'category_id');
    }

    public function curve()
    {
        return $this->hasMany(CurveCategory::class);
    }

    public function field()
    {
        return $this->belongsToMany(DeviceField::class, 'device_category_curves','category_id','field_id');
    }
}
