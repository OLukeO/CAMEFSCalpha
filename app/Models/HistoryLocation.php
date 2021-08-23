<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryLocation extends Model
{
    use HasFactory;

    protected $table = 'history_location';
    //public $primaryKey = 'uid';

    protected $fillable = [
        'uid', 'state', 'rssi', 'distance', 'txpower',
    ];
}
