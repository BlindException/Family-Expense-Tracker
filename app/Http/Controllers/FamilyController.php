<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreFamilyRequest;
use App\Http\Requests\UpdateFamilyRequest;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('families.index', [
'families' => auth()->user()->families,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('families.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFamilyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFamilyRequest $request)
    {
        $user = auth()->user();
        $validated = $request->validated();
        $validated['password'] = Crypt::encryptString($request->validated('password'));
                                                                                                    $user->createdFamilies()->create($validated);
        $familyMember = [
                        'family_id' => $user->latestCreatedFamily->id,
                        'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('family_users')->insert($familyMember);
        
        return redirect(route('families.index'));
    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        $this->authorize('view', $family);
        return view('families.show', [
            'family' => $family,
        ]);
    }
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family)
    {
        $this->authorize('update', $family);
        return view('families.edit', [
            'family' => $family,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFamilyRequest  $request
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFamilyRequest $request, Family $family)
    {
        $this->authorize('update', $family);

        $validated = $request->validated();
        $validated['password'] = Crypt::encryptString($request->validated('password'));
        $family->update($validated);
        return redirect(route('families.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        $this->authorize('delete', $family);
        DB::table('family_users')->where('family_id', '=', $family->id)->delete();
        DB::table('transactions')->where('owner_type', '=', 'App\Models\Family')->where('owner_id', '=', $family->id)->delete();
        $family->delete();
        return redirect(route('families.index'));
    }
}
