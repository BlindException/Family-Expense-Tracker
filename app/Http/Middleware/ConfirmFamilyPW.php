<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ConfirmFamilyPW
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $family = Family::where('name', '=', $request->input('name'))->firstOrFail();
        if (!Hash::check($request->input('password'), $family->password) == true) {
            return redirect(route('familyusers.create'))->withInput()->withErrors('Family Name or Password Incorrect');
        } else {
            return $next($request);
        }
    }
}