<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }


    public  function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carhistory()
    {
        return $this->belongsTo(CarHistory::class ,'car_history_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

}
