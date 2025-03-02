<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\student_credentials; 
use App\Models\FeeDetail;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function authenticate(Request $request)
    {
        if (!$request->isMethod('post')) {
            abort(405, 'Method Not Allowed'); // Return 405 error for invalid methods
        }

        $studentId = $request->input('student-id');
        $password = $request->input('password');

        $student = student_credentials::where('student_id', $studentId)->first();
        // Example authentication logic
        if ($studentId === $student-> student_id && (password_verify($password, $student->password))) {
            $request->session()->put('user', $student);
            $user = $request->session()->get('user');
            $student1 = Student::where('student_id', $user->student_id)->first();
            $feeDetails = FeeDetail::where('student_id', $student1->student_id)
            ->get();
            
            return view('/student/student-dashboard',[
                'student' => $student1,
                'feeDetails' => $feeDetails,
            ]);
        } 
        else {
            return redirect()->back()->with('error', 'Invalid student ID or password.');
        }

        return back()->withErrors(['Invalid credentials'])->withInput();
    }

    public function personalInfo(Request $request)
    {
        // Get the logged-in user
        $user = $request->session()->get('user');
        // Assuming the logged-in user is associated with a student
        $student = Student::with('guardians')->where('student_id', $user->student_id)->first(); // Fetch student for logged-in user
        // Check if student data exists
        if (!$student) {
            return abort(404, 'Student not found');
        }

        // Pass student data to the personal-info Blade view
        return view('/student/personal-info', [
            'student' => $student,
            'guardians' => $student->guardians, // Get guardians from the relationship
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect('/student-login');
    }

}
