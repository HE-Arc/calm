<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'stop',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }
}
