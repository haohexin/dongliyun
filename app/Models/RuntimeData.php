<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuntimeData extends Model
{
    protected $table = 'runtime_data';
    protected $primaryKey = 'runtime_data_id';
    public $timestamps = false;

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
