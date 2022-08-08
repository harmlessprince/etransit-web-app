<?php

namespace App\Models;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NyscCamp extends Model
{
    use HasFactory;

    public function location(){
        $this->belongsTo(Destination::class);
    }
}
