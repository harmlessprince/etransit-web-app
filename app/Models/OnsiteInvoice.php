<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnsiteInvoice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }
    public function OnsiteCustomer(){
        return $this->belongsTo(OnsiteCustomer::class);
    }
    public function Schedule(){
        return $this->belongsTo(Schedule::class);
    }
}

