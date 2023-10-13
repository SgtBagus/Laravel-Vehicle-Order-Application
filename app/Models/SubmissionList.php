<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionList extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'submission_name', 'reason', 'vehicle_id', 'note', 'start_date', 'end_date', 'approve_by', 'status', 'created_at', 'updated_at',
    ];
}
