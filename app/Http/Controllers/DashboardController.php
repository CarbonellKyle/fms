<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        $isCurrent = false;

        $lastSeason = DB::table('seasons')->orderBy('start_date', 'DESC')->first(); //most recent season
        //$reminder = DB::table('appdata')->where('key', 'reminder')->first();
        $reminder = File::get(public_path('/text/reminder.txt'));

        //if no seasons yet
        if(empty($lastSeason)){
            return view('dashboard.index')->with('isCurrent', false)->with('profit', 0)->with('loss', 0)->with('reminder', $reminder);
        }

        //If last season has ended, therefore, there is no active season
        if($lastSeason->end_date!=null){
            return view('dashboard.index')->with('isCurrent', false)->with('profit', 0)->with('loss', 0)->with('reminder', $reminder);
        }

        $isCurrent = true; //This means that the most recent season is active

        $wage = DB::table('labor_wages')->where('season_id', $lastSeason->season_id)->sum('wage');
        $matExpense = DB::table('material_expenses')->where('season_id', $lastSeason->season_id)->sum('cost');
        $tax = DB::table('taxes')->where('season_id', $lastSeason->season_id)->sum('amount');
        $totalExpenses = $wage + $matExpense + $tax; //Total expenses of current season

        $totalYield = DB::table('yields')->where('season_id', $lastSeason->season_id)->sum('quantity'); //Total yield of current season
        $totalRevenue = DB::table('revenues')->where('season_id', $lastSeason->season_id)->sum('total_price'); //Total raw income of current season
        $profit = $totalRevenue - $totalExpenses; //Profit of current season
        $loss = $profit; //Loss hold the value of profit (more explaination on the view file)
        if($profit<0) {
            $profit = 0; //To output zero instead of negative value
        }

        return view('dashboard.index', compact('isCurrent', 'lastSeason', 'totalExpenses', 'totalYield', 'totalRevenue', 'profit', 'wage', 'matExpense', 'tax', 'reminder', 'loss')); 
    }

    public function startSeason(Request $request)
    {
        //Simply creating a new season with null end_date. Null end_date means season hasn't ended yet and is ongoing
        DB::table('seasons')->insert([
            'start_date' => now(),
        ]);

        return back();
    }

    public function endSeason(Request $request)
    {
        $lastSeason = DB::table('seasons')->orderBy('start_date', 'DESC')->first(); //Getting the most recent active (null end_date) season
        //Ending the season by inserting the end_date
        DB::table('seasons')->where('season_id', $lastSeason->season_id)->update([
            'end_date' => now(),
        ]);

        return back();
    }

    public function updateReminder(Request $request)
    {
        $path = public_path('/text/reminder.txt');
        File::put($path, $request->reminder);
        return back();
    }
}
