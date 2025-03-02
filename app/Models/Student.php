<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $fillable = [
        'student_id', 'email',  'phone', 'dob', 'address', 'first_name', 'last_name', 'gender'
    ];

    public function guardians()
    {
        return $this->hasOne(Guardian::class, 'student_id', 'student_id');
    }

    public function AcademicDetails()
    {
        return $this->hasOne(AcademicDetails::class, 'student_id', 'student_id');
    }

    public function FeeDetail()
    {
        return $this->hasMany(FeeDetail::class, 'student_id', 'student_id');
    }

    public function student_credentials()
    {
        return $this->hasOne(student_credentials::class, 'student_id', 'student_id');
    }

    public function feeSummary()
    {
        return $this->hasOne(FeeSummary::class, 'student_id', 'student_id'); // Adjust table and column names if necessary
    }


}