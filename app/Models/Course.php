<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses'; // Table Name

    protected $primaryKey = 'id'; // Primary Key

    public $timestamps = false; // Disable timestamps (if not needed)

    protected $fillable = [
        'CourseCode', 
        'CourseName',  
        'Duration', 
        'Department',
        'CourseType'
    ];

    public function academicDetails()
    {
        return $this->hasMany(AcademicDetails::class, 'Course', 'course_code');
    }
}
