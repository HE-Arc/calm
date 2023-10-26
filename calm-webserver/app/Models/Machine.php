<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
    ];

    public function laundry()
    {
        return $this->belongsTo(Laundry::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }
}
