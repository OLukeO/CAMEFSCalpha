<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peopleandbeacon extends Model
{
    use HasFactory;
    public $timestamps = false; 
    protected $fillable = [
        'logtime',
        'beaconid',
        'rssi',
        'distance',
        'txpower',
        'uid'
    ];

}
