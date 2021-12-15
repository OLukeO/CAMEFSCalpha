<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $table = 'monitoring';

    protected $fillable = [
        'uid', 'sidimei', 'name', 'lat', 'lng', 'distance', 'sos',
    ];

    public $timestamps = false;
}
