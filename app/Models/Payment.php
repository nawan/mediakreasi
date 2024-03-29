<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
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

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    //payments
    // protected $guarded = [];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function alat()
    // {
    //     return $this->belongsTo(Alat::class);
    // }

    // public function event()
    // {
    //     return $this->belongsTo(Event::class);
    // }
}
