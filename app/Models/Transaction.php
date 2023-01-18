<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends model
{
    use HasFactory;
    protected $fillable = [
'title',
'details',
'amount',
'paid_at',
'transaction_type_id',
'transaction_category_id',
    ];
    public function type()
    {
        return $this->belongsTo(TransactionType::class);
    }
    public function category()
    {
        return $this->belongsTo(TransactionCategory::class, 'transaction_category_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function owner()
    {
        return $this->morphTo();
    }
}
