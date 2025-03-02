<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Specify the table name (optional if it matches the plural of the model name)
    protected $table = 'transactions';

    // Define the columns that are mass assignable
    protected $fillable = [
        'transaction_id',
        'student_id',
        'date',
        'description',
        'amount',
        'status',
        'payment_mode',
        'proof_image',
        'fee_type_id',
        'created_at',
        'updated_at',
    ];

    // Cast specific columns to the correct data types (optional)
    protected $casts = [
        'date' => 'datetime',
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define any relationships (for example, if you want to access student details through transaction)
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function feeType()
    {
        return $this->belongsTo(FeeType::class, 'fee_type_id', 'fee_type_id');
    }

    // Define a custom accessor for formatting the status (optional)
    public function getStatusFormattedAttribute()
    {
        return ucfirst($this->status);
    }
}
