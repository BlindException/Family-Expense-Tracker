<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Family;
use App\Models\FamilyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class FamilyUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(Request $request) 
{
        $keys = $request->keys();
        $id = $keys[0];
        $family = Family::where('id', '=', $id)->get();
        
                        return view('familyusers.index', [
'familyUsers' => $family[0]->users()->get(),
'family' => $family[0],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('familyusers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password');
        $family = Family::where('name', '=', $name)->where('password', '=', $password)->get();
        if (count($family) === 1) {
            $familyMember = [
                'family_id' => $family[0]->id,
                'user_id' => auth()->user()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DB::table('family_users')->insert($familyMember);
            return redirect(route('families.index'));
        }else{
            return back()->withInput()->withErrors('Family does not exist or password is incorrect');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FamilyUser  $familyUser
     * @return \Illuminate\Http\Response
     */
    public function show(FamilyUser $familyUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FamilyUser  $familyUser
     * @return \Illuminate\Http\Response
     */
    public function edit(FamilyUser $familyUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FamilyUser  $familyUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FamilyUser $familyUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FamilyUser  $familyUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $familyuser, Request $request)
    {
        $family = $request->query('family');
                        DB::table('family_users')->where('family_id', '=', $family)->where('user_id', '=', $familyuser->id)->delete();
                return redirect(route('families.index'));
    }
}
