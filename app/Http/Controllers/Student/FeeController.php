<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller; 
use App\Models\FeeDetail;
use App\Models\FeeSummary;
use App\Models\FeeType;
use App\Models\Student;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    // Method to show the fee details of a student
    public function show(Request $request)
    {
        $user = $request->session()->get('user');
        // Fetch all fee details for the student
        $feeDetails = FeeDetail::with('feeType')  // Eager load feeType
            ->where('student_id', $user->student_id)
            ->get();
        
        // Fetch the student data
        $student = Student::where('student_id', $user->student_id)->first();
        $latestPaymentDate = $feeDetails->max('payment_date');
        $feeSummary = FeeSummary::where('student_id', $user->student_id)->first();
        // Return the data to the view
        return view('/student/fee-details', [
            'student' => $student,
            'feeDetails' => $feeDetails, // Get guardians from the relationship
            'lastPaymentDate' => $latestPaymentDate,
            'feeSummary' => $feeSummary
        ]);
    }

    public function store(Request $request)
    {
        // Store data in flash session
        session()->flash('amount', $request->amount);
        session()->flash('fee_name', $request->fee_name);
        session()->flash('fee_type_id', $request->fee_type_id);

        // Redirect to the pay-now page (handled by another controller)
        return redirect()->route('pay-now');
    }

    // Method to create and store fee details
    // public function store(Request $request)
    // {
    //     // Validate incoming request
    //     $request->validate([
    //         'student_id' => 'required|exists:students,student_id',
    //         'academic_year' => 'required',
    //         'total_fees' => 'required|numeric',
    //         'paid_amount' => 'required|numeric',
    //         'fee_type_id' => 'required|exists:fee_types,fee_type_id',
    //         'payment_status' => 'required|in:Paid,Partially Paid,Pending',
    //         'payment_mode' => 'required|in:Cash,Card,Bank Transfer,UPI'
    //     ]);

    //     // Create a new fee detail
    //     FeeDetail::create($request->all());

    //     // Redirect or show a success message
    //     return redirect()->route('fees.show', $request->student_id)->with('success', 'Fee details added successfully.');
    // }
}
