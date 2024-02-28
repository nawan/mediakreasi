<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function event()
    {
        return $this->hasMany(Event::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function tool_events()
    {
        return $this->hasMany(Tool_events::class);
    }
}
