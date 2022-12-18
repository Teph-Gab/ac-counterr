<?php

namespace App\Http\Controllers\Api;

use App\Models\Sheet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sheets = Sheet::where('user_id', Auth::id())->get();
        return response()->json($sheets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sheet = new Sheet;
        $sheet->name = $request->name;
        $sheet->url = $request->url;
        $sheet->category = $request->category;
        $sheet->user_id = Auth::id();
        $sheet->save();

        return response()->json($sheet);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function show(Sheet $sheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sheet $sheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sheet $sheet)
    {
        //
    }
}
