<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'stop',
        'description',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine');
    }
}
