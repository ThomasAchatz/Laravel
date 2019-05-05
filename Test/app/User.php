<?php
namespace App;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'isAdmin', 'firstname', 'lastname', 'street', 'street_number', 'city', 'zip_code', 'country'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function books() : HasMany {
        return $this->hasMany('Book::class');


    }
    public function orders() : BelongsToMany {
        return $this->belongsToMany(Order::class);
    }


    public function getJWTIdentifier(){
        return $this->getKey();
    }
    public function getJWTCustomClaims(){
        return ['user' => ['id'=>$this->id, 'isAdmin'=>$this->isAdmin]];
    }
}