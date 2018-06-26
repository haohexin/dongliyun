<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceCategoryCurve extends Model
{
    protected $fillable = ['field_id', 'category_id', 'bit', 'length'];

    public function category()
    {
        return $this->belongsTo(DeviceCategory::class, 'category_id');
    }

    public function field()
    {
        return $this->belongsTo(DeviceField::class, 'field_id');
    }
}
