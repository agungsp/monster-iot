<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Device extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $device = 'devices';

    /**
     * The users that belong to the Device
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_device', 'device_id', 'user_id');
    }

    /**
     * The contracts that belong to the Device
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function contracts()
    {
        return $this->belongsToMany(Contract::class, 'contract_device', 'device_id', 'contract_id');
    }

    /**
     * Get the user's id.
     *
     * @return array
     */
    public function getUserIdsAttribute()
    {
        return $this->users->pluck('id')->toArray();
    }

    /**
     * Get the contract's id.
     *
     * @return array
     */
    public function getContractIdsAttribute()
    {
        return $this->contracts->pluck('id')->toArray();
    }

    /**
     * Check user
     *
     * @param User $user User
     * @return bool
     **/
    public function hasUser(User $user)
    {
        return in_array($user->id, $this->user_ids);
    }

    /**
     * Check contract
     *
     * @param Contract $contract Contract
     * @return bool
     **/
    public function hasContract(Contract $contract)
    {
        return in_array($contract->id, $this->contract_ids);
    }

    /**
     * Add user
     *
     * @param User $user User
     * @return void
     **/
    public function addUser(User $user)
    {
        if ($this->hasUser($user)) return;
        $this->users()->attach($user->id);
    }

    /**
     * Add contract
     *
     * @param Contract $contract Contract
     * @return void
     **/
    public function addContract(Contract $contract)
    {
        if ($this->hasContract($contract)) return;
        $this->contracts()->attach($contract->id);
    }

    /**
     * Remove user
     *
     * @param User $user User
     * @return void
     **/
    public function removeUser(User $user)
    {
        if (!$this->hasUser($user)) return;
        $this->users()->detach($user->id);
    }

    /**
     * Remove contract
     *
     * @param Contract $contract Contract
     * @return void
     **/
    public function removeContract(Contract $contract)
    {
        if (!$this->hasContract($contract)) return;
        $this->contracts()->detach($contract->id);
    }

    /**
     * Update/Sync users
     *
     * @param Collection $users users
     * @return void
     **/
    public function updateUser(Collection $users)
    {
        $this->users()->sync($users->pluck('id'));
    }

    /**
     * Update/Sync contracts
     *
     * @param Collection $contracts Contracts
     * @return void
     **/
    public function updateContract(Collection $contracts)
    {
        $this->contracts()->sync($contracts->pluck('id'));
    }
}
