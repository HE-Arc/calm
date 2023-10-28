<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'stop',
    ];

    protected $casts = [
        'start' => 'datetime',
        'stop' => 'datetime'
    ];

    public function machine() : BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function duration()
    {
        return $this->stop->diffInMinutes($this->start);
    }

    public function organization()
    {
        return $this->machine->organization();
    }

    public function laundry()
    {
        return $this->machine->laundry();
    }

}
