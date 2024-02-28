<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
        'nik',
        'no_kontak',
        'alamat',
        'email',
        'password',
        'image',
        'is_admin',
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
    ];

    /**
     * ini adalah function ORM
     */

    public function event()
    {
        return $this->hasMany(Event::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function crew_events()
    {
        return $this->hasMany(Crew_events::class);
    }

    public function gravatar(): Attribute
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return new Attribute(
            get: fn () => "http://www.gravatar.com/avatar/$hash",
        );
    }
}
