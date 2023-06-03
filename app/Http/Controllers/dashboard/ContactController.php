<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $contact = contact::all();
        return response()->view('dashboard.contact.index', compact('contact'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('dashboard.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $data = new contact();
        $data->address = $request->input('address');
        $data->mobile = $request->input('mobile');
        $data->email = $request->input('email');
        $data->website = $request->input('website');
        $saved = $data->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = contact::find($id);
        return response()->view('dashboard.contact.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $data = contact::findOrFail ($id);
        $data->address = $request->input('address');
        $data->mobile = $request->input('mobile');
        $data->email = $request->input('email');
        $data->website = $request->input('website');
        $saved = $data->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $deleteCount = contact::destroy($id);
        return redirect()->back();
    }
}
