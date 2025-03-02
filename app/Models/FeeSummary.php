<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeSummary extends Model
{
    protected $table = 'FeeSummary'; // Name of the view
    protected $primaryKey = 'student_id';
    public $incrementing = false;
    public $timestamps = false; // Views don’t have created_at or updated_at

    protected $fillable = [
        'student_id', 'academic_year', 'total_paid', 'overdue_total', 'grand_total', 'payment_status'
    ];
}
