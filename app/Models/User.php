<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Panoscape\History\HasOperations;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasOperations;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'intro',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function role()
    // {
    // return $this->belongsTo('Database\Mi');
    // }

    // public function user_truyen()
    // {
    //     return $this->hasMany('App\Models\User','user_id','id');
    // }

    public function truyen() 
    {
        return $this->hasMany(Truyen::class,'App\Models\Truyen', 'user_id','truyen_id');
    }
}
