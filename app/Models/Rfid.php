<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rfid extends Model
{
    use HasFactory;
    // protected $fillable = ['uuid', 'brand', 'type', 'sn', 'buy_at', 'kilometer_start', 'kilometer_end', 'is_broken', 'created_by', 'updated_by'];

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = 'rfids';
}
