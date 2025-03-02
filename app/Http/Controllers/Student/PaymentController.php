<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Session;
use App\Models\FeeType;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Show the Pay Now Page
    public function showPayNowPage(Request $request)
    {
        // $feeTypes = FeeType::All();
        $feeDetails = [
            'amount' => $request->amount,
            'fee_name' => $request->fee_name,
            'fee_type_id' => $request->fee_type_id
        ];

        return view('/student/paynow', compact('feeDetails'));
    }

    // Handle payment submission and file upload
    public function submitPayment(Request $request)
    {
        // Validate the request
        $request->validate([
            'amount' => 'required|numeric',
            'fee_type_id' => 'required|integer',
            'payment_mode' => 'required|string|in:Bank Transfer,UPI',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048', // 2MB max
        ]);

        // Read image as binary data
        $imageBinary = base64_encode(file_get_contents($request->file('payment_proof')->getRealPath()));
        
        $user = $request->session()->get('user');

        $lastTransaction = Transaction::orderBy('created_at', 'desc')->first();
        $nextId = $lastTransaction ? ((int) substr($lastTransaction->transaction_id, 4)) + 1 : 1001;
        // Save payment details including image in the database
        Transaction::create([
            'transaction_id' => 'TXN-' . $nextId,
            'student_id' => $user->student_id,
            'amount' => $request->amount,
            'date' => now(),
            'status' => 'Pending',
            'payment_mode' => $request->payment_mode,
            'description' => $request->description ?? 'No description provided',
            'proof_image' => $imageBinary,
            'fee_type_id' => $request->fee_type_id
        ]);
        

        return back()->with('success', 'Payment submitted successfully.');
    }
}
