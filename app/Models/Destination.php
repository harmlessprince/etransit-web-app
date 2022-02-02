<?php

namespace App\Models;

use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function terminals()
    {
        return $this->hasMany(Terminal::class);
    }

}
