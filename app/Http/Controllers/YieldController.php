<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class YieldController extends Controller
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
        $lastSeason = DB::table('seasons')->orderBy('start_date', 'DESC')->first();
        //if no seasons yet
        if(empty($lastSeason)){
            return view('yield.index', ['inactive' => 'You need to start a season first!', 'numRows' => 0, 'monthly_count' => 0]);
        }

        //if season is not started yet
        if($lastSeason->end_date!=null){
            return view('yield.index', ['inactive' => 'You need to start a season first!', 'numRows' => 0, 'monthly_count' => 0]);
        }

        $season_id = $lastSeason->season_id;

        //Get yields this month only
        $now = Carbon::now();
        $monthly_yields = DB::table('yields')
        ->join('users', 'yields.user_id', 'users.id')
        ->select('yields.*', 'users.name as username')
        ->where('season_id', $season_id)->whereMonth('date', $now->month)->whereYear('date', $now->year)
        ->orderBy('date', 'DESC')->paginate(5);
        $monthly_count = count($monthly_yields);

        //Get All Yields Records this Season
        $yields = DB::table('yields')
        ->join('users', 'yields.user_id', 'users.id')
        ->select('yields.*', 'users.name as username')
        ->where('season_id', $season_id)->orderBy('date', 'DESC')->paginate(5);
        $numRows = count($yields);

        //Get total yields this season
        $total = DB::table('yields')->where('season_id', $season_id)->sum('quantity');

        return view('yield.index', compact('yields', 'numRows', 'monthly_yields', 'monthly_count', 'total', 'now', 'season_id'));
    }

    public function addYield()
    {
        $lastSeason = DB::table('seasons')->orderBy('start_date', 'DESC')->first(); //current season
        $season_id = $lastSeason->season_id;
        return view('yield.add', compact('season_id'));
    }

    public function addYieldSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'season_id' => 'required',
            'quantity' => 'required|numeric',
            'date' => 'required'
        ]);

        DB::table('yields')->insert([
            'season_id' => $request->season_id,
            'quantity' => $request->quantity,
            'user_id' => auth()->user()->id,
            'date' => $request->date
        ]);
        return back()->with('record_added', 'Harvest has been recorded!');
    }

    public function editYield($id)
    {
        $yield = DB::table('yields')->where('yield_id', $id)->first();
        return view('yield.edit', compact('yield'));
    }

    public function updateYield(Request $request)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|numeric',
            'date' => 'required'
        ]);

        DB::table('yields')->where('yield_id', $request->id)->update([
            'quantity' => $request->quantity,
            'date' => $request->date
        ]);
        return back()->with('record_updated', 'Record Updated Successfully!');
    }

    public function deleteYield($id){
        DB::table('yields')->where('yield_id', $id)->delete();
        return back()->with('record_deleted', 'Record has been deleted!');
    }
}
