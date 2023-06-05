<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenew extends Model
{
    use HasFactory;
     protected $fillable = ['operator', 'service_id', 'revenew','entry_date'];
}
