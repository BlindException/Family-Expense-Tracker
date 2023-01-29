<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;


class FamilyUser extends Pivot
{
    protected $table = "family_users";
    protected $fillable = [
        'family_id',
        'user_id',
    ];
    public function family()
    {
        return $this->belongsTo(Family::class, 'family_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    //
}
