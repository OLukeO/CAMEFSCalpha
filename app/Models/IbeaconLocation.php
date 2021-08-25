<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbeaconLocation extends Model
{
    use HasFactory;

    protected $table = 'ibeacon_location';
    public $primaryKey = 'id';

    protected $guarded = [
        'id', 'major', 'minor', 'lan', 'lng', 'uuid'
    ];


}
