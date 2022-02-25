<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
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

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function tenants()
    {
        return $this->belongsToMany(Tenant::class ,'service_tenant');
    }

}
