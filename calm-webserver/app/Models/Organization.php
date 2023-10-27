<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_in_organizations', 'user', 'organization');
    }

    public function laundries()
    {
        return $this->hasMany(Laundry::class, 'organization');
    }


}
