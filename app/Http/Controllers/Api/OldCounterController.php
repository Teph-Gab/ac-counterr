<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
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

    public function getWeeklyData()
    {
        $mon = Carbon::parse('last Monday')->format('Y-m-d');
        $tue = Carbon::parse('last tuesday')->format('Y-m-d');
        $wed = Carbon::parse('last wednesday')->format('Y-m-d');
        $thu = Carbon::parse('last thursday')->format('Y-m-d');
        $fri = Carbon::parse('last friday')->format('Y-m-d');
        $sat= Carbon::parse('last saturday')->format('Y-m-d');
        $sun = Carbon::parse('last sunday')->format('Y-m-d');

        $totalMonday = 0;
        $totalTuesday = 0;
        $totalWednesday = 0;
        $totalThursday = 0;
        $totalFriday = 0;
        $totalSaturday = 0;
        $totalSunday = 0;
       
        $monday = OldCounter::where('user_id', Auth::id())->where('created_at', 'like', '%'.$mon.'%')->get('completedacs');
        $tuesday = OldCounter::where('user_id', Auth::id())->where('created_at', 'like', '%'.$tue.'%')->get('completedacs');
        $wednesday = OldCounter::where('user_id', Auth::id())->where('created_at', 'like', '%'.$wed.'%')->get('completedacs');
        $thursday = OldCounter::where('user_id', Auth::id())->where('created_at', 'like', '%'.$thu.'%')->get('completedacs');
        $friday = OldCounter::where('user_id', Auth::id())->where('created_at', 'like', '%'.$fri.'%')->get('completedacs');
        $saturday = OldCounter::where('user_id', Auth::id())->where('created_at', 'like', '%'.$sat.'%')->get('completedacs');
        $sunday = OldCounter::where('user_id', Auth::id())->where('created_at', 'like', '%'.$sun.'%')->get('completedacs');

        for ($i=0; $i < $monday->count(); $i++) { 
            $totalMonday = $totalMonday + $monday[$i]->count();
        }
        for ($i=0; $i < $tuesday->count(); $i++) { 
            $totalTuesday = $totalTuesday + $tuesday[$i]->count();
        }
        for ($i=0; $i < $wednesday->count(); $i++) { 
            $totalWednesday = $totalWednesday + $wednesday[$i]->count();
        }
        for ($i=0; $i < $thursday->count(); $i++) { 
            $totalThursday = $totalThursday + $thursday[$i]->count();
        }
        for ($i=0; $i < $friday->count(); $i++) { 
            $totalFriday = $totalFriday + $friday[$i]->count();
        }
        for ($i=0; $i < $saturday->count(); $i++) { 
            $totalSaturday = $totalSaturday + $saturday[$i]->count();
        }
        for ($i=0; $i < $sunday->count(); $i++) { 
            $totalSunday =  $totalSunday + $sunday[$i]->count();
        }
        

        return response()->json(["allcompleted"=>[$totalMonday, $totalTuesday, $totalWednesday, $totalThursday, $totalFriday, $totalSaturday, $totalSunday]]);
    }

    public function getMonthlyData()
    {
        // Completed
        $januaryCompleted = 0;
        $februaryCompleted = 0;
        $marchCompleted = 0;
        $aprilCompleted = 0;
        $mayCompleted = 0;
        $juneCompleted = 0;
        $julyCompleted = 0;
        $augustCompleted = 0;
        $septemberCompleted = 0;
        $octoberCompleted = 0;
        $novemberCompleted = 0;
        $decemberCompleted = 0;

        // Restart
        $januaryRestart = 0;
        $februaryRestart = 0;
        $marchRestart = 0;
        $aprilRestart = 0;
        $mayRestart = 0;
        $juneRestart = 0;
        $julyRestart = 0;
        $augustRestart = 0;
        $septemberRestart = 0;
        $octoberRestart = 0;
        $novemberRestart = 0;
        $decemberRestart = 0;

        // Launched
        $januaryLaunched = 0;
        $februaryLaunched = 0;
        $marchLaunched = 0;
        $aprilLaunched = 0;
        $mayLaunched = 0;
        $juneLaunched = 0;
        $julyLaunched = 0;
        $augustLaunched = 0;
        $septemberLaunched = 0;
        $octoberLaunched = 0;
        $novemberLaunched = 0;
        $decemberLaunched = 0;

        // Completed
        $january = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('january')->format('m'))->whereYear('created_at',Carbon::parse('january')->format('Y'))->get(['completedacs']);
        $february = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('february')->format('m'))->whereYear('created_at',Carbon::parse('february')->format('Y'))->get(['completedacs']);
        $march = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('march')->format('m'))->whereYear('created_at',Carbon::parse('march')->format('Y'))->get(['completedacs']);
        $april = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('april')->format('m'))->whereYear('created_at',Carbon::parse('april')->format('Y'))->get(['completedacs']);
        $may = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('may')->format('m'))->whereYear('created_at',Carbon::parse('may')->format('Y'))->get(['completedacs']);
        $june = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('june')->format('m'))->whereYear('created_at',Carbon::parse('june')->format('Y'))->get(['completedacs']);
        $july = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('july')->format('m'))->whereYear('created_at',Carbon::parse('july')->format('Y'))->get(['completedacs']);
        $august = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('august')->format('m'))->whereYear('created_at',Carbon::parse('august')->format('Y'))->get(['completedacs']);
        $september = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('september')->format('m'))->whereYear('created_at',Carbon::parse('september')->format('Y'))->get(['completedacs']);
        $october = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('october')->format('m'))->whereYear('created_at',Carbon::parse('october')->format('Y'))->get(['completedacs']);
        $november = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('november')->format('m'))->whereYear('created_at',Carbon::parse('november')->format('Y'))->get(['completedacs']);
        $december = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('december')->format('m'))->whereYear('created_at',Carbon::parse('december')->format('Y'))->get(['completedacs']);

        // Restart
        $jan = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('january')->format('m'))->whereYear('created_at',Carbon::parse('january')->format('Y'))->get(['restartacs']);
        $feb = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('february')->format('m'))->whereYear('created_at',Carbon::parse('february')->format('Y'))->get(['restartacs']);
        $mar = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('march')->format('m'))->whereYear('created_at',Carbon::parse('march')->format('Y'))->get(['restartacs']);
        $apr = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('april')->format('m'))->whereYear('created_at',Carbon::parse('april')->format('Y'))->get(['restartacs']);
        $ma = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('may')->format('m'))->whereYear('created_at',Carbon::parse('may')->format('Y'))->get(['restartacs']);
        $jun = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('june')->format('m'))->whereYear('created_at',Carbon::parse('june')->format('Y'))->get(['restartacs']);
        $jul = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('july')->format('m'))->whereYear('created_at',Carbon::parse('july')->format('Y'))->get(['restartacs']);
        $aug = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('august')->format('m'))->whereYear('created_at',Carbon::parse('august')->format('Y'))->get(['restartacs']);
        $sep = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('september')->format('m'))->whereYear('created_at',Carbon::parse('september')->format('Y'))->get(['restartacs']);
        $oct = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('october')->format('m'))->whereYear('created_at',Carbon::parse('october')->format('Y'))->get(['restartacs']);
        $nov = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('november')->format('m'))->whereYear('created_at',Carbon::parse('november')->format('Y'))->get(['restartacs']);
        $dec = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('december')->format('m'))->whereYear('created_at',Carbon::parse('december')->format('Y'))->get(['restartacs']);

        // Launched
        $januaryL = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('january')->format('m'))->whereYear('created_at',Carbon::parse('january')->format('Y'))->get(['launchedacs']);
        $februaryL = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('february')->format('m'))->whereYear('created_at',Carbon::parse('february')->format('Y'))->get(['launchedacs']);
        $marchL = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('march')->format('m'))->whereYear('created_at',Carbon::parse('march')->format('Y'))->get(['launchedacs']);
        $aprilL = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('april')->format('m'))->whereYear('created_at',Carbon::parse('april')->format('Y'))->get(['launchedacs']);
        $mayL = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('may')->format('m'))->whereYear('created_at',Carbon::parse('may')->format('Y'))->get(['launchedacs']);
        $juneL = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('june')->format('m'))->whereYear('created_at',Carbon::parse('june')->format('Y'))->get(['launchedacs']);
        $julyL = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('july')->format('m'))->whereYear('created_at',Carbon::parse('july')->format('Y'))->get(['launchedacs']);
        $augustL = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('august')->format('m'))->whereYear('created_at',Carbon::parse('august')->format('Y'))->get(['launchedacs']);
        $septemberL = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('september')->format('m'))->whereYear('created_at',Carbon::parse('september')->format('Y'))->get(['launchedacs']);
        $octoberL = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('october')->format('m'))->whereYear('created_at',Carbon::parse('october')->format('Y'))->get(['launchedacs']);
        $novemberL = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('november')->format('m'))->whereYear('created_at',Carbon::parse('november')->format('Y'))->get(['launchedacs']);
        $decemberL = OldCounter::where('user_id', Auth::id())->whereMonth( 'created_at', Carbon::parse('december')->format('m'))->whereYear('created_at',Carbon::parse('december')->format('Y'))->get(['launchedacs']);

        // Completed
        if (count($january) != 0) {
            $januaryCompleted = count($january[0]->completedacs);
        }
        if (count($february) != 0) {
            $februaryCompleted = count($february[0]->completedacs);
        }
        if (count($march) != 0) {
            $marchCompleted = count($march[0]->completedacs);
        }
        if (count($april) != 0) {
            $aprilCompleted = count($april[0]->completedacs);
        }
        if (count($may) != 0) {
            $mayCompleted = count($may[0]->completedacs);
        }
        if (count($june) != 0) {
            $juneCompleted = count($june[0]->completedacs);
        }
        if (count($july) != 0) {
            $julyCompleted = count($july[0]->completedacs);
        }
        if (count($august) != 0) {
            $augustCompleted = count($august[0]->completedacs);
        }
        if (count($september) != 0) {
            $septemberCompleted = count($september[0]->completedacs);
        }
        if (count($october) != 0) {
            $octoberCompleted = count($october[0]->completedacs);
        }
        if (count($november) != 0) {
            $novemberCompleted = count($november[0]->completedacs);
        }
        if (count($december) != 0) {
            $decemberCompleted = count($december[0]->completedacs);
        }

        // Restart
        if (count($jan) != 0) {
            $januaryRestart = count($jan[0]->restartacs);
        }
        if (count($feb) != 0) {
            $februaryRestart = count($feb[0]->restartacs);
        }
        if (count($mar) != 0) {
            $marchRestart = count($mar[0]->restartacs);
        }
        if (count($apr) != 0) {
            $aprilRestart = count($apr[0]->restartacs);
        }
        if (count($ma) != 0) {
            $mayRestart = count($ma[0]->restartacs);
        }
        if (count($jun) != 0) {
            $juneRestart = count($jun[0]->completedacs);
        }
        if (count($jul) != 0) {
            $julyRestart = count($jul[0]->restartacs);
        }
        if (count($aug) != 0) {
            $augustRestart = count($aug[0]->restartacs);
        }
        if (count($sep) != 0) {
            $septemberRestart = count($sep[0]->restartacs);
        }
        if (count($oct) != 0) {
            $octoberRestart = count($oct[0]->restartacs);
        }
        if (count($nov) != 0) {
            $novemberRestart = count($nov[0]->restartacs);
        }
        if (count($dec) != 0) {
            $decemberRestart = count($dec[0]->restartacs);
        }

        // Launched
        if (count($januaryL) != 0) {
            $januaryLaunched = count($januaryL[0]->launchedacs);
        }
        if (count($februaryL) != 0) {
            $februaryLaunched = count($februaryL[0]->launchedacs);
        }
        if (count($marchL) != 0) {
            $marchLaunched = count($marchL[0]->launchedacs);
        }
        if (count($aprilL) != 0) {
            $aprilLaunched = count($aprilL[0]->launchedacs);
        }
        if (count($mayL) != 0) {
            $mayLaunched = count($mayL[0]->launchedacs);
        }
        if (count($juneL) != 0) {
            $juneLaunched = count($juneL[0]->launchedacs);
        }
        if (count($julyL) != 0) {
            $julyLaunched = count($julyL[0]->launchedacs);
        }
        if (count($augustL) != 0) {
            $augustLaunched = count($augustL[0]->launchedacs);
        }
        if (count($septemberL) != 0) {
            $septemberLaunched = count($septemberL[0]->launchedacs);
        }
        if (count($octoberL) != 0) {
            $octoberLaunched = count($octoberL[0]->launchedacs);
        }
        if (count($novemberL) != 0) {
            $novemberLaunched = count($novemberL[0]->launchedacs);
        }
        if (count($decemberL) != 0) {
            $decemberLaunched = count($decemberL[0]->launchedacs);
        }

        return response()->json([
            "allcompleted" => [$januaryCompleted, $februaryCompleted, $marchCompleted, $aprilCompleted, $mayCompleted, $juneCompleted, $julyCompleted, $augustCompleted, $septemberCompleted, $octoberCompleted, $novemberCompleted, $decemberCompleted],
            "allrestart" => [$januaryRestart, $februaryRestart, $marchRestart, $aprilRestart, $mayRestart, $juneRestart, $julyRestart, $augustRestart, $septemberRestart, $octoberRestart, $novemberRestart, $decemberRestart],
            "alllaunched" => [$januaryLaunched, $februaryLaunched, $marchLaunched, $aprilLaunched, $mayLaunched, $juneLaunched, $julyLaunched, $augustLaunched, $septemberLaunched, $octoberLaunched, $novemberLaunched, $decemberLaunched]
            ]);
    }

    /**
     * Store a newly created resource in stoRestart
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
