<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AcademicDetails extends Model
{
    use HasFactory;

    // Define the table name (if it doesn't follow the plural convention)
    protected $table = 'AcademicDetails';

    // Specify the fillable attributes (columns you want to insert or update)
    protected $fillable = [
        'student_id', 'Course', 'Branch', 'Semester', 'AdmissionDate'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'Course', 'CourseCode');
    }

}
