<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'started_at', 'expired_at', 'created_by', 'updated_by'];

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = 'contracts';
}
