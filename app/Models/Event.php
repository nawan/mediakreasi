<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function event_tools()
    {
        return $this->hasMany(Event_tools::class);
    }

    public function event_crews()
    {
        return $this->hasMany(Event_crews::class);
    }

    //event

    // protected $guarded = [];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function alat()
    // {
    //     return $this->belongsTo(Alat::class);
    // }

    // public function payment()
    // {
    //     return $this->hasMany(Payment::class);
    // }
}
