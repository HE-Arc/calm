<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_activated',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'is_activated' => 'boolean'
    ];

    public function organizations()
    {
        return $this
            ->belongsToMany(Organization::class, 'users_in_organizations')
            ->withPivot('invitation_id')
            ->withPivot('joined_at');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function invitation(string $orgId)
    {
        // explicitly no "find or fail"
        return Invitation::find(
            $this
                ->organizations
                ->where('id', $orgId)
                ->first
                ->pivot
                ->pivot
                ->invitation_id
        );
    }

    public function joined_at(string $orgId){
        $ts = strtotime($this
            ->organizations
            ->where('id', $orgId)
            ->first
            ->pivot
            ->pivot
            ->joined_at
        );

        return !$ts ? null : new Carbon($ts);
    }
}
