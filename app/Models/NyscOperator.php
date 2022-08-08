<?php

namespace App\Models;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NyscOperator extends Model
{
    use HasFactory;

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
