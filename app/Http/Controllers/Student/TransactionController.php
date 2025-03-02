<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller; 
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function showTransactionHistory(Request $request)
    {
        $user = $request->session()->get('user');  // Assuming the student is logged in

        // Fetch transactions for the logged-in student
        $transactions = Transaction::where('student_id', $user->student_id)->get();
        // Pass the transactions to the view
        return view('/student/transaction-history', [
            'transactions' => $transactions,
        ]);
    }
}
