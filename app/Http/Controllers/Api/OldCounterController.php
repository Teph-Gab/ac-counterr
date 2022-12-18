<?php

namespace App\Http\Controllers\Api;

use App\Models\OldCounter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OldCounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oldacs = OldCounter::where('user_id', Auth::id())->get();
        return response()->json($oldacs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OldCounter  $oldCounter
     * @return \Illuminate\Http\Response
     */
    public function show(OldCounter $oldCounter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OldCounter  $oldCounter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OldCounter $oldCounter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OldCounter  $oldCounter
     * @return \Illuminate\Http\Response
     */
    public function destroy(OldCounter $oldCounter)
    {
        //
    }
}
