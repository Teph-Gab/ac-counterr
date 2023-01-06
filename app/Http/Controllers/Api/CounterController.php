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
        $launchedTab = [];
        $duplicatedTab = [];

        //Check for duplicated
        $dupCompleted = array_count_values($request->total_completed_acs);
        $dupRestart = array_count_values($request->total_restart_acs);
        $dupLaunched = array_count_values($request->total_launched_acs);

        foreach ($dupCompleted as $key => $value) {
            if ($value > 1) {
                $duplicatedTab[] = $key;
            }
        }

        foreach ($dupRestart as $key => $value) {
            if ($value > 1) {
                $duplicatedTab[] = $key;
            }
        }

        foreach ($dupLaunched as $key => $value) {
            if ($value > 1) {
                $duplicatedTab[] = $key;
            }
        }

        $mergeCompleted = array_unique($request->total_completed_acs);
        $mergeRestart = array_unique($request->total_restart_acs);
        $mergeLaunched = array_unique($request->total_launched_acs);


        foreach ($mergeCompleted as $key => $value) {
            $completedTab[] = $value;
        }

        foreach ($mergeRestart as $key => $value) {
            $restartTab[] = $value;
        }

        foreach ($mergeLaunched as $key => $value) {
            $launchedTab[] = $value;
        }

        $acs = new Counter;
        $acs->completedacs = $completedTab;
        $acs->restartacs = $restartTab;
        $acs->launchedacs = $launchedTab;
        $acs->duplicateacs = $duplicatedTab;
        $acs->user_id = Auth::id();
        $acs->save();

        return response()->json($acs);
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
        $launchedTab = [];
        $duplicatedTab = [];

        $counter = Counter::findOrFail($counter->id);

          //Check for duplicated
          $dupCompleted = array_count_values(array_merge($request->total_completed_acs, $counter->completedacs));
          $dupRestart = array_count_values(array_merge($request->total_restart_acs, $counter->restartacs));
          $dupLaunched = array_count_values(array_merge($request->total_launched_acs, $counter->launchedacs));
  
          foreach ($dupCompleted as $key => $value) {
              if ($value > 1) {
                  $duplicatedTab[] = $key;
              }
          }
  
          foreach ($dupRestart as $key => $value) {
              if ($value > 1) {
                  $duplicatedTab[] = $key;
              }
          }
  
          foreach ($dupLaunched as $key => $value) {
              if ($value > 1) {
                  $duplicatedTab[] = $key;
              }
          }
        //End chek duplicated

        $mergeCompleted = array_unique(array_merge($request->total_completed_acs, $counter->completedacs));
        $mergeRestart = array_unique(array_merge($request->total_restart_acs, $counter->restartacs));
        $mergeLaunched = array_unique(array_merge($request->total_launched_acs, $counter->launchedacs));


        foreach ($mergeCompleted as $key => $value) {
            $completedTab[] = $value;
        }

        foreach ($mergeRestart as $key => $value) {
            $restartTab[] = $value;
        }

        foreach ($mergeLaunched as $key => $value) {
            $launchedTab[] = $value;
        }

        $counter->update(['completedacs' => $completedTab]);
        $counter->update(['restartacs' => $restartTab]);
        $counter->update(['launchedacs' => $launchedTab]);
        $counter->update(['duplicateacs' => $duplicatedTab]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Counter $counter)
    {
        $restartTab = [];
        $completedTab = [];
        $launchedTab = [];
        $duplicatedTab = [];

        $count = Counter::findOrFail($counter->id);
        
        $old_count = OldCounter::where('user_id',Auth::id())->get();

        if (count($old_count) > 0) {
            $o_count = OldCounter::where('user_id',Auth::id());
           
            $mergeCompleted = array_unique(array_merge($old_count[0]->completedacs, $count->completedacs));
            $mergeRestart = array_unique(array_merge($old_count[0]->restartacs, $count->restartacs));
            $mergeLaunched = array_unique(array_merge($old_count[0]->launchedacs, $count->launchedacs));

            foreach ($mergeCompleted as $key => $value) {
                $completedTab[] = $value;
            }

            foreach ($mergeRestart as $key => $value) {
                $restartTab[] = $value;
            }

            foreach ($mergeLaunched as $key => $value) {
                $launchedTab[] = $value;
            }

            if ($count->duplicateacs && $old_count[0]->duplicateacs) {
                $mergeDuplicated = array_unique(array_merge($old_count[0]->duplicateacs, $count->duplicateacs));
                foreach ($mergeDuplicated as $key => $value) {
                    $duplicatedTab[] = $value;
                }
            }
            else{
                $mergeDuplicated = array_unique($count->duplicateacs);
                foreach ($mergeDuplicated as $key => $value) {
                    $duplicatedTab[] = $value;
                }
            }

            $o_count->update(['completedacs' => $completedTab]);
            $o_count->update(['restartacs' => $restartTab]);
            $o_count->update(['launchedacs' => $launchedTab]);
            $o_count->update(['duplicateacs' =>  $duplicatedTab]);
        }
        else{
            $oldCounter = new OldCounter;
            $oldCounter->completedacs = $count['completedacs'];
            $oldCounter->restartacs = $count['restartacs'];
            $oldCounter->launchedacs = $count['launchedacs'];
            $oldCounter->duplicateacs = $count['duplicateacs'];
            $oldCounter->user_id = Auth::id();
            $oldCounter->save();   
        }

        Counter::destroy($count->id);
    }

    public function showButton()
    {
        $showbutton = Counter::where('user_id', Auth::id())->count();
        return response()->json($showbutton);
    }

}