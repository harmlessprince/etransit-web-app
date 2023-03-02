<?php

namespace App\Models;

use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destination extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function terminals()
    {
        return $this->hasMany(Terminal::class);
    }
    public function nyscHub(){
        return $this->hasMany(NyscHub::class,'location_id','id');
    }
    public function nyscCamp(){
        return $this->hasOne(NyscCamp::class);
    }
}
