<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\AcademicDetails;
use App\Models\Guardian;
use App\Models\FeeDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ManagementController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        $courses = Course::all();
        return view('/management/register', compact('courses'));
    }

    public function getBranches(Request $request)
    {
        $courseType = $request->course; // Get selected course type (B.Tech or M.Tech)
        $branches = Course::where('CourseType', $courseType)
                            ->get(); // Filter by course type

        return response()->json($branches); // Return as JSON for AJAX
    }

    /**
     * Store new student details.
     */
    public function store(Request $request)
    {
        try {
            // Validate Input Data
            $request->validate([
                'student_id' => 'required|string|max:50|unique:students,student_id',
                'email' => 'required|email|max:255|unique:students,email',
                'phone' => 'required|string|max:20|regex:/^[0-9]+$/',
                'dob' => 'required|date',
                'address' => 'required|string',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'gender' => 'required|string|max:10',
                'course' => 'required|string|max:20',  
                'course_id' => 'required|string|max:50',  // Branch
                'semester' => 'required|integer|min:1|max:8',
                'admission_date' => 'required|date',
                'guardian_name' => 'required|string|max:100',
                'guardian_relation' => 'required|string|max:50',
                'guardian_phone' => 'required|string|max:20|regex:/^[0-9]+$/'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        

        try {
            DB::beginTransaction(); // Start Transaction
        
            // Store Student
            $student = Student::create([
                'student_id' => $request->student_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'email' => $request->email,
                'phone' => $request->phone,
                'dob' => $request->dob,
                'address' => $request->address
            ]);
        
            // Debugging to check if student is created
            if (!$student) {
                throw new \Exception("Student creation failed.");
            }
        
            // Store Academic Details
            AcademicDetails::create([
                'student_id' => $student->student_id,
                'Course' => $request->course,
                'Branch' => $request->course_id, // Branch ID
                'Semester' => $request->semester,
                'AdmissionDate' => $request->admission_date
            ]);
            // Store Guardian Details
            Guardian::create([
                'student_id' => $student->student_id,
                'guardian_name' => $request->guardian_name,
                'relationship' => $request->guardian_relation,
                'phone' => $request->guardian_phone
            ]);
        
            // Generate Default Password
            $firstLetter = strtoupper(substr($request->first_name, 0, 1));
            $lastName = strtolower($request->last_name);
            $dobYear = date('Y', strtotime($request->dob));
            $defaultPassword = $firstLetter . $lastName .'@'. $dobYear;
        
            // Hash Password and Store in Authentication Table
            DB::table('student_credentials')->insert([
                'student_id' => $student->student_id,
                'password' => Hash::make($defaultPassword)
            ]);

            // **Automatically Add Default Fees**
            // FeeDetail::create([
            //     'student_id' => $student->student_id,
            //     'academic_year' => date('Y') . '-' . (date('Y') + 1), // Example: 2024-2025
            //     'total_fees' => 0, // Default: No fee assigned yet
            //     'paid_amount' => 0, // Default: No payment
            //     'next_due_date' => null, // Default: No due date yet
            //     'payment_status' => 'Pending', // Default status
            //     'payment_mode' => null, // No payment mode yet
            //     'remarks' => 'Pending fee details', // Default remark
            //     'fee_type_id' => null, // No fee type assigned yet
            //     'total_paid' => 0, // Default: No fee paid
            //     'overdue_total' => 0, // Default: No overdue
            //     'grand_total' => 0 // Default: No fee calculated
            // ]);

        
            DB::commit();
            return back()->with('success', 'Student registered successfully! Default Password: ' . $defaultPassword);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('error.page')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }   

    /**
     * Show all registered students.
     */
    public function viewStudents(Request $request)
    {
        $students = Student::with('AcademicDetails')->paginate(10);
        $branches = AcademicDetails::select('Branch')->distinct()->get();
        $courses = AcademicDetails::select('Course')->distinct()->get();

        return view('/management/viewstudents', compact('students', 'branches', 'courses'));
    }

    public function filter(Request $request)
    {
        $query = Student::with(['academicDetails']); 
            // Apply Student ID filter
        if ($request->filled('student_id')) {
            $query->where('student_id', 'like', '%' . $request->student_id . '%');
        }

        // Apply Branch filter
        if ($request->filled('branch')) {
            $query->whereHas('academicDetails', function ($q) use ($request) {
                $q->where('Branch', $request->branch);
            });
        }

        // Apply Course filter (if required)
        if ($request->filled('course')) {
            $query->whereHas('academicDetails', function ($q) use ($request) {
                $q->where('Course', $request->course);
            });
        }

        if ($request->filled('semester')) {
            $query->whereHas('academicDetails', function ($q) use ($request) {
                $q->where('Semester', $request->semester);
            });
        }
        $students = $query->with('academicDetails')->paginate(10);

        // Fetch Branches for Filter
        $branches = AcademicDetails::select('Branch')->distinct()->get();
        $courses = AcademicDetails::select('Course')->distinct()->get();

        return view('/management/viewstudents', compact('students','branches','courses'));
    }

    public function show($student_id)
    {
        $student = Student::with(['academicDetails', 'guardians', 'FeeDetail'])
            ->where('student_id', $student_id)
            ->firstOrFail();

        return view('management.viewstudent', compact('student'));
    }


    public function edit($id)
    {
        $student = Student::with(['AcademicDetails.course', 'guardians'])
                      ->where('student_id', $id)
                      ->first();;
        $branches = AcademicDetails::select('Branch')->distinct()->pluck('Branch');
        $courses = Course::whereIn('CourseCode', $branches)->distinct()->get();
        return view('/management/update-student', compact('student', 'branches', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'dob' => 'required|date',
            'address' => 'required|string|max:255',
            'branch' => 'required|string',
            'course' => 'required|string',
            'semester' => 'required|integer|min:1|max:8',
            'guardian_name' => 'required|string|max:255',
            'guardian_relation' => 'required|string',
            'guardian_phone' => 'required|digits:10'
        ]);

        $student = Student::where('student_id', $id)->firstOrFail();
        $student->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'address' => $request->address
        ]);

        AcademicDetails::where('student_id', $student->student_id)->update([
            'Branch' => $request->branch,
            'Course' => $request->course,
            'Semester' => $request->semester
        ]);

        $student->guardians->update([
            'guardian_name' => $request->guardian_name,
            'relationship' => $request->guardian_relation,
            'phone' => $request->guardian_phone
        ]);

        return redirect()->route('view-students')->with('success', 'Student details updated successfully!');
    }

    /**
     * Show fee details.
     */
    public function viewFees(Request $request)
    {
        $query = Student::with(['academicDetails', 'feeDetail']); // Eager load related data

        // Apply Student ID filter
        if ($request->filled('student_id')) {
            $query->where('student_id', 'like', '%' . $request->student_id . '%');
        }

        // Apply Branch filter
        if ($request->filled('branch')) {
            $query->whereHas('academicDetails', function ($q) use ($request) {
                $q->where('Branch', $request->branch);
            });
        }

        // Apply Course filter (if required)
        if ($request->filled('course')) {
            $query->whereHas('academicDetails', function ($q) use ($request) {
                $q->where('Course', $request->course);
            });
        }

        if ($request->filled('semester')) {
            $query->whereHas('academicDetails', function ($q) use ($request) {
                $q->where('Semester', $request->semester);
            });
        }

        // Fetch students along with their AcademicDetails
        $students = $query->with('academicDetails')->paginate(10);

        // Get available branches and courses for the filters
        $branches = AcademicDetails::select('Branch')->distinct()->get();
        $courses = AcademicDetails::select('Course')->distinct()->get();
        
        return view('/management/viewfees', compact('students', 'branches', 'courses'));
    }

    public function showFeeDetails($student_id)
    {
        $student = Student::with('FeeDetail.feeType')->where('student_id', $student_id)->firstOrFail();
        return view('management.fee-details', compact('student'));
    }
}