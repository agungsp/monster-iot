<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Device extends Model
{
    use HasFactory;
    protected $table = 'user_device';

    /**
     * The users that belong to the Device
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_device', 'device_id', 'user_id');
    }
}
