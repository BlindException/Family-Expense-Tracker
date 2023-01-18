<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\TransactionCategory;
use App\Http\Requests\StoreTransactionCategoryRequest;
use App\Http\Requests\UpdateTransactionCategoryRequest;

class TransactionCategoryController extends Controller
{
 
/**Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transactionCategories.index', [
            'transactionCategories' => TransactionCategory::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactionCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionCategoryRequest $request)
    {
        $validated = $request->validated();
    DB::table('transaction_categories')->insert($validated);
    return redirect(route('transactioncategories.index'));
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionCategory  $transactionCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionCategory $transactioncategory)
    {
        $this->authorize('update', $transactioncategory);
        Return  view('transactionCategories.edit', [
            'transactioncategory' => $transactioncategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionCategoryRequest  $request
     * @param  \App\Models\TransactionCategory  $transactionCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionCategoryRequest $request, TransactionCategory $transactioncategory)
    {
        $this->authorize('update', $transactioncategory);
        $validated = $request->validated();
        $transactioncategory->update($validated);
        return redirect(route('transactioncategories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionCategory  $transactionCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionCategory $transactioncategory)
    {
        $this->authorize('delete', $transactioncategory);
        $transactioncategory->delete();
        return redirect(route('transactioncategories.index'));
    }
}
