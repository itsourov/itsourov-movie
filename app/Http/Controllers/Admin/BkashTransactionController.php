<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BkashTransaction;

class BkashTransactionController extends Controller
{
    public function index()
    {
        $bkashTransactions = BkashTransaction::paginate(20);
        return view('admin.bt.index', [
            'bkashTransactions' => $bkashTransactions,
        ]);
    }
    public function show(BkashTransaction $bkashTransaction)
    {
        return $bkashTransaction;
    }
}
