<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LicenseRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\License;

use Session;

class LicensesController extends Controller
{
    // 
    public function __construct() {
        $this->middleware('admin', ['except' => ['index','show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $licenses = License::orderBy('license_name')->paginate(20);
        $count = License::count();
        return view('forms.licenses.index', compact('licenses', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.licenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LicenseRequest $request)
    {
        $input = $request->all();
        $input['slug'] = str_slug($input['license_name']);
        License::create($input);
        Session::flash('flash_message', 'License successfully updated!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($license_id)
    {
        $license = License::findOrFail($license_id);
        return view('forms.licenses.edit', compact('license'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LicenseRequest $request, $license_id)
    {
        $license = License::findOrFail($license_id);
        $input = $request->all();
        // un-comment the line below to update the slug
        // $input['slug'] = str_slug($input['publisher_name']);

        $license->fill($input)->save();
        Session::flash('flash_message', 'License successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($license_id)
    {
        $license = License::findOrFail($license_id);
        $license->delete();
        Session::flash('flash_message', 'License successfully deleted!');
        return redirect()->route('licenses.index');
    }
}
