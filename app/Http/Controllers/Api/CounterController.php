<?php

namespace App\Http\Controllers\Api;

use App\Models\Counter;
use App\Models\OldCounter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CounterResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $acs = Counter::all();
        $acs = Counter::where('user_id', Auth::id())->get();
        return response()->json($acs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $completedTab = [];
        $restartTab = [];

        $mergeCompleted = array_unique($request->total_completed_acs);
        $mergeRestart = array_unique($request->total_restart_acs);

        foreach ($mergeCompleted as $key => $value) {
            $completedTab[] = $value;
        }

        foreach ($mergeRestart as $key => $value) {
            $restartTab[] = $value;
        }

        $acs = new Counter;
        $acs->completedacs = $completedTab;
        $acs->restartacs = $restartTab;
        $acs->user_id = Auth::id();
        $acs->save();

        // return response()->json($acs);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function show(Counter $counter)
    {
        $ac = Counter::findOrFail($counter->id);

        return response()->json($ac);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Counter $counter)
    {
        $restartTab = [];
        $completedTab = [];

        $counter = Counter::findOrFail($counter->id);

        $mergeCompleted = array_unique(array_merge($request->total_completed_acs, $counter->completedacs));
        $mergeRestart = array_unique(array_merge($request->total_restart_acs, $counter->restartacs));


        foreach ($mergeCompleted as $key => $value) {
            $completedTab[] = $value;
        }

        foreach ($mergeRestart as $key => $value) {
            $restartTab[] = $value;
        }

        $counter->update(['completedacs' => $completedTab]);
        $counter->update(['restartacs' => $restartTab]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Counter $counter)
    {
        $count = Counter::findOrFail($counter->id);

        $oldCounter = new OldCounter;
        $oldCounter->completedacs = $count->completedacs;
        $oldCounter->restartacs = $count->restartacs;
        $oldCounter->user_id = Auth::id();
        $oldCounter->save();

        Counter::destroy($count->id);
    }

    public function showButton()
    {
        $showbutton = Counter::where('user_id', Auth::id())->count();
        return response()->json($showbutton);
    }

}
