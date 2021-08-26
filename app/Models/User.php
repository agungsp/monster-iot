<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'company_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the company that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * The devices that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function devices()
    {
        return $this->belongsToMany(Device::class, 'user_device', 'user_id', 'device_id');
    }

    /**
     * Get the device's id.
     *
     * @return array
     */
    public function getDeviceIdsAttribute()
    {
        return $this->devices->pluck('id')->toArray();
    }

    /**
     * Check device
     *
     * @param Device $device Device
     * @return bool
     **/
    public function hasDevice(Device $device)
    {
        return in_array($device->id, $this->device_ids);
    }

    /**
     * Add device
     *
     * @param Device $device Device
     * @return void
     **/
    public function addDevice(Device $device)
    {
        if ($this->hasDevice($device)) return;
        $this->devices()->attach($device->id);
    }

    /**
     * Remove device
     *
     * @param Device $device Device
     * @return void
     **/
    public function removeDevice(Device $device)
    {
        if (!$this->hasDevice($device)) return;
        $this->devices()->detach($device->id);
    }

    /**
     * Update/Sync devices
     *
     * @param Collection $devices Devices
     * @return void
     **/
    public function updateDevice(Collection $devices)
    {
        $this->devices()->sync($devices->pluck('id'));
    }
}
