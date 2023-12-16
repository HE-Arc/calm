<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invitation extends Model
{
    //use HasFactory;

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function userCount(){
        return User::join('users_in_organizations', 'users.id', '=', 'user_id')
            ->where('invitation_id', $this->id)->count();
    }

    public static function create(string $orgId){
        $invitation = new Invitation();
        $unique = false;

        while(!$unique){
            $code = strtoupper(Str::random(5));
            if(Invitation::where('code', $code)->count() == 0){
                $unique = true;
            }
        }

        $invitation->code = $code;
        $invitation->organization_id = $orgId;
        return $invitation;
    }

}
