<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone', 'website', 'address', 'created_by', 'updated_by'];

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = 'companies';

    /**
     * Get all of the users for the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'id');
    }
}
