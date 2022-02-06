<?php

namespace App\Models;

use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    public function eticketusers()
    {
        return $this->hasMany(Eticket::class);
    }

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }


}
