<?php

namespace App\Models;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NyscHub extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function location(){
      return  $this->belongsTo(Destination::class);
    }
}
