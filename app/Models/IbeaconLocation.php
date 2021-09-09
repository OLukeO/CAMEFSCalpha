<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbeaconLocation extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'ibeacon_location';
    public $primaryKey = 'id';

    protected $fillable = [
        'id', 'major', 'minor', 'lat', 'lng', 'uuid',
    ];
}
