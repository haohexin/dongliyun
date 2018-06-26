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
}
