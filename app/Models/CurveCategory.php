<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurveCategory extends Model
{
    protected $fillable = ['device_category_id', 'title'];

    public function deviceCategory()
    {
        return $this->belongsTo(DeviceCategory::class);
    }

    public function fields()
    {
        return $this->belongsToMany(DeviceField::class, 'curve_category_fields','curve_category_id','field_id');
    }
}
