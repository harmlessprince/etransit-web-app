<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTrustee extends Model
{
    use HasFactory;
    protected $table = 'user_trustees';

    protected $guarded = ['id'];

}
