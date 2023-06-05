<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    use HasFactory;
        protected $fillable = ['operator', 'activation', 'deactivation', 'service_id', 'create_date'];
}
