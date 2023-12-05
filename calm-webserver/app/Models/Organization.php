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
        return $this->belongsToMany(User::class, 'users_in_organizations');

    }

    public function laundries()
    {
        return $this->hasMany(Laundry::class);
    }

    public function nonAdminUsers()
    {
        return $this->users->where('is_admin', 0);
    }

    public function adminUsers()
    {
        return $this->users->where('is_admin', 1);
    }

}
