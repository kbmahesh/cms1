<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'guardians';

    // Define the primary key if it's different from 'id'
    protected $primaryKey = 'id'; // Change this if you have a different primary key column

    // If your table uses timestamps
    public $timestamps = true;

    // Define the fillable fields (for mass assignment)
    protected $fillable = [
        'student_id', 
        'guardian_name', 
        'relationship', 
        'phone'
    ];

    // Optionally, define any relationships (if applicable)
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
