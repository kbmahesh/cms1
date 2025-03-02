<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\FeeDetail;
use App\Models\FeeType;
use App\Models\Transaction;
use App\Models\Course;
use App\Models\AcademicDetails;
use Illuminate\Http\Request;

class AddFeeController extends Controller
{
    public function create()
    {
        $students = Student::all();
        $branches = AcademicDetails::select('Branch')->distinct()->get();
        $courses = AcademicDetails::select('Course')->distinct()->get();
        $feeTypes = FeeType::all();
        return view('/management/addfees', compact('students','branches','courses','feeTypes'));
    }

    public function submitFee(Request $request)
    {

        FeeDetail::create([
            'student_id' => $request->student_id,
            'academic_year' => date('Y') . '-' . (date('Y') + 1), // Example: 2024-2025
            'total_fees' => $request->amount, // Default: No fee assigned yet
            'paid_amount' => 0, // Default: No payment
            'next_due_date' => $request->due_date, // Default: No due date yet
            'payment_status' => 'Pending', // Default status
            'payment_mode' => null, // No payment mode yet
            'remarks' => 'Pending fee details', // Default remark
            'fee_type_id' => $request->fee_category, // No fee type assigned yet
        ]);

        return redirect()->back()->with('success', 'Fee added successfully!');
    }

    public function fetchStudent($id)
    {
        $student = Student::where('student_id', $id)
            ->with(['AcademicDetails.course'])
            ->first();
        if ($student) {
            return response()->json(['success' => true, 'student' => $student]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function fetchStudents(Request $request)
    {
        $students = Student::where('Branch', $request->branch)
                            ->where('Course', $request->course)
                            ->where('Semester', $request->semester)
                            ->get();

        return response()->json(['students' => $students]);
    }

    public function submitBatchFee(Request $request)
    {
        foreach ($request->students as $student) {
            Fee::create([
                'student_id' => $student['id'],
                'amount' => $student['amount'],
                'fee_type' => $request->feeType,
                'due_date' => now()->addDays(30),
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function pendingReceipts()
    {
        $transactions = Transaction::where('status', 'Pending')->get();
        return view('/management/verifyreceipts', compact('transactions'));
    }

    public function viewReceipt($transaction_id)
    {
        $transaction = Transaction::where('transaction_id', $transaction_id)->firstOrFail();
        return view('/management/view-receipt', compact('transaction'));
    }

    public function approveReceipt(Request $request, $transaction_id)
    {

        Transaction::where('transaction_id', $transaction_id)->update([
            'status' => 'Completed',  // Ensure this value is allowed by the CHECK constraint
        ]);

        $transaction = Transaction::where('transaction_id', $transaction_id)->firstOrFail();

        FeeDetail::where('student_id', $transaction->student_id)
            ->where('fee_type_id', $transaction->fee_type_id) // Ensure correct fee type
            ->update([
                'paid_amount' => $transaction->amount,
                'payment_date' => $transaction->date,
                'payment_status' => 'Paid',
                'payment_mode' => $transaction->payment_mode
            ]);

        return redirect()->route('transactions.pending')->with('success', 'Transaction approved successfully.');
    }
}
