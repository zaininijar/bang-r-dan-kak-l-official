<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExchangeController extends Controller
{
    public function index(): View
    {
        $transactions = Transaction::orderBy('created_at', 'DESC')->get();
        return view('admin.transactions', ['transactions' => $transactions]);
    }

    public function search($query)
    {
        $filteredTransactions = Transaction::with(['user', 'exchange'])
            ->where(function ($q) use ($query) {
                $q->whereHas('user', function ($userQuery) use ($query) {
                    $userQuery->where('username', 'LIKE', '%' . $query . '%');
                })
                ->orWhereHas('exchange', function ($exchangeQuery) use ($query) {
                    $exchangeQuery->where('exchange_type', 'LIKE', '%' . $query . '%')
                        ->orWhere('exchanged_to', 'LIKE', '%' . $query . '%');
                });
            })
            ->orWhere('account_identity', 'LIKE', '%' . $query . '%')
            ->orderBy('created_at', 'ASC')
            ->get();

        return response()->json($filteredTransactions, 200);
    }

    public function destroy(string $id)
    {

        try {
            $transaction = Transaction::find($id);
            $transaction->delete();
            return redirect()->back()->with('success', 'success delete transaction with transaction ID : ' . $transaction->id);

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }

}
