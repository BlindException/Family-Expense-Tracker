<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionType;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\TransactionCategory;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $transactions = $user->transactions()->get();
        $families = $user->families()->get();
        foreach($families as $family)
        {
            $familyTransactions = $family->transactions()->get();
            if(count($familyTransactions)>0)
            {
                $transactions = $transactions->merge($familyTransactions);
            }
        }
return view('transactions.index', [
            'transactions' =>  $transactions,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions.create', [
            'transactionTitles' => Transaction::all(),
            'transactionTypes' => TransactionType::all(),
            'transactionCategories' => TransactionCategory::all(),
            'myFamilies' => auth()->user()->families()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'details' => ['max:255'],
            'amount' => ['required'],
            'paid_at' => ['required'],
            'transaction_type_id' => ['required'],
            'transaction_category_id' => ['required'],
            'creator_id' => ['required'],
            'owner_id' => ['required'],
            'owner_type' => ['required', 'string'],
            
                    ]);
        DB::table('transactions')->insert($validated);
        return redirect(route('transactions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $this->authorize('view', $transaction);
        return view('transactions.show', [
            'transaction' => $transaction,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $this->authorize('update', $transaction);
        return view('transactions.edit', [
            'transactionTitles' => Transaction::all(),
            'transactionTypes' => TransactionType::all(),
            'transactionCategories' => TransactionCategory::all(),
            'myFamilies' => auth()->user()->families()->get(),
'transaction' => $transaction,
]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $this->authorize('update', $transaction);
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'details' => ['max:255'],
            'amount' => ['required'],
            'paid_at' => ['required'],
            'transaction_type_id' => ['required'],
            'transaction_category_id' => ['required'],
            'creator_id' => ['required'],
            'owner_id' => ['required'],
            'owner_type' => ['required', 'string'],
                        'updated_at' => now(),
                    ]);
        $transaction->update($validated);
        return redirect(route('transactions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $this->authorize('delete', $transaction);
        $transaction->delete();
        return redirect(route('transactions.index'));
    }
}
