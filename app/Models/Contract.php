<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Contract extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * The devices that belong to the Contract
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function devices()
    {
        return $this->belongsToMany(Device::class, 'contract_device', 'contract_id', 'device_id');
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
