<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerryType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function ferries()
    {
        return $this->hasMany(Ferry::class);
    }
}
