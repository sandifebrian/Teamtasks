<?php

namespace App\Http\Controllers;

use App\Http\Resources\Organization as OrganizationCollection;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizations = Organization::all();

        return OrganizationCollection::collection($organizations);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create(Request $request)
    // {
    //     $organization = new Organization($request->input());

    //     return new OrganizationCollection($organization);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $organization = Organization::create($request->input());
        return new OrganizationCollection($organization);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization)
    {
        return response($organization->load(['projects']));
        // return new OrganizationCollection($organization->with(['members', 'projects']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Organization $organization)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organization $organization)
    {
        $organization = $organization->fill($request->input());
        $organization->save();

        return new OrganizationCollection($organization);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization)
    {
        if ($organization->delete())
        {
            return response(['message' => "$organization->name has been deleted."]);
        }
        {
            return response(['message' => "failed to delete $organization->name."]);
        }

    }

    public function addMembers(Request $request, Organization $organization)
    {
        if (Organization->addMembers($request->members))
        {
            return response(['message' => "Berhasil menambahkan Member ke $organization->name."]);
        }
        {
            return response(['message' => "Gagal menambahkan Member ke $organization->name."]);
        }
    }
}
