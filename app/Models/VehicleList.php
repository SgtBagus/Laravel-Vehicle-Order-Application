<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleList extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'number_vechile', 'fuel', 'created_by', 'updated_by', 'created_at', 'updated_at',
    ];
}
