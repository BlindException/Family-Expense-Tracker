<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'password',
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'family_users')->using(FamilyUser::class)->withTimestamps();
    }
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'owner');
    }
}
