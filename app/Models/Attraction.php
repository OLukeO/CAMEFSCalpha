<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'logtime',
        'peoplenumber',
        'beaconid',
        'lat',
        'lng',
        'viewname',
        'note',
        'image',
        'url',
    ];
}
