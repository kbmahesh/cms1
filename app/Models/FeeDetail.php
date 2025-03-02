<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class FeeDetail extends Model
{
    use HasFactory;

    // Define the table name (if it doesn't follow the plural convention)
    protected $table = 'fees_details';

    public $timestamps = false;
    // Specify the fillable attributes (columns you want to insert or update)
    protected $fillable = [
        'student_id', 'academic_year', 'total_fees', 'paid_amount', 'next_due_date', 'due_amount',
        'payment_status', 'payment_mode', 'remarks', 'fee_type_id',
    ];

    // Define relationships if needed
    public function feeType()
    {
        return $this->belongsTo(FeeType::class, 'fee_type_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
