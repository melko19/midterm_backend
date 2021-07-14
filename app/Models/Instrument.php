<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'definition',
        'type',
        'price',
        'acquired_on',
        'range'
    ];

    public function container() {
        return $this->belongsTo('App\Models\Instrument', 'name', 'id');
    }
}
