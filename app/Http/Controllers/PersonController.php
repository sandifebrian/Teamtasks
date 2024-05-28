<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Organization;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Organization $org)
    {
        return response($org->members);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $user = new User();
        $user->fill($request->input());
        $user->save();

        $person = new Person();
        $person->fill($request->input());
        $person->userInfo()->associate($user);

        $this->__setOrganization($person, $request->input('organization_id'));

        $person->save();

        if (DB::status()) {
            DB::commit();
            return response($person);
        } else {
            DB::rollback();
            return response([
                'message' => 'Gagal menyimpan data Pengguna',
                'status' => 500
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        return response($person);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Person $person)
    {
        $person->fill($request->input());
        $person->userInfo()->associate($user);

        $this->__setOrganization($person, $request->input('organization_id'));

        $person->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        if($person->delete())
        {
            return response(['message' => "$person->name has been deleted."]);
        }
        {
            return response(['message' => "failed to delete $person->name."]);
        }
    }

    private function __setOrganization(Person &$person, $organizationId)
    {
        if (!is_null($organizationId)) {
            $organization = Organization::find($organizationId);
            if ($organization) {
                $person->organization()->associate($organization);
            }
        }
    }
}
