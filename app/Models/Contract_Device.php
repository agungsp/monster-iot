<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract_Device extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'contract_id', 'device_id'];

    public function devices()
    {
        return $this->belongsTo(Device::class, 'device_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    protected $table = 'contract_device';
}
