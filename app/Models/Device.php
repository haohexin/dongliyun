<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'device';
    public $timestamps = false;

    public function category()
    {
        return $this->hasOne(DeviceCategory::class, 'id', 'category_id');
    }

    public function curveCategory()
        {
            return $this->hasOne(CurveCategory::class, 'id', 'curve_category_id')->withDefault(
                ['title' => '暂无']
            );
        }

    public function region()
    {
        return $this->hasOne(Region::class, 'region_id', 'base_district_region');
    }

    public function province()
    {
        return $this->hasOne(Province::class, 'province_id', 'base_district_province');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'city_id', 'base_district_city');
    }

    public function runtimedata()
    {
        return $this->hasMany(RuntimeData::class, 'device_id');
    }
}
