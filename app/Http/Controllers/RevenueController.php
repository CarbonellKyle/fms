<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RevenueController extends Controller
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
            return view('revenue.index', ['inactive' => 'You need to start a season first!', 'numRows' => 0, 'monthly_count' => 0]);
        }

        //if season is not started yet
        if($lastSeason->end_date!=null){
            return view('revenue.index', ['inactive' => 'You need to start a season first!', 'numRows' => 0, 'monthly_count' => 0]);
        }

        $season_id = $lastSeason->season_id;

        //Get revenue this month only
        $now = Carbon::now();
        $monthly_revenues = DB::table('revenues')
        ->join('users', 'revenues.user_id', 'users.id')
        ->select('revenues.*', 'users.name as username')
        ->where('season_id', $season_id)->whereMonth('date', $now->month)->whereYear('date', $now->year)
        ->orderBy('date', 'DESC')->paginate(5);
        $monthly_count = count($monthly_revenues);

        //Get All Revenue this Season
        $revenues = DB::table('revenues')
        ->join('users', 'revenues.user_id', 'users.id')
        ->select('revenues.*', 'users.name as username')
        ->where('season_id', $season_id)->orderBy('date', 'DESC')->paginate(5);
        $numRows = count($revenues);

        //Get total revenue this season
        $total = DB::table('revenues')->where('season_id', $season_id)->sum('total_price'); //Total Income of Current Season

        return view('revenue.index', compact('revenues', 'numRows', 'monthly_revenues', 'monthly_count', 'total', 'now', 'season_id'));
    }

    public function addRevenue()
    {
        $lastSeason = DB::table('seasons')->orderBy('start_date', 'DESC')->first(); //current season
        $season_id = $lastSeason->season_id;
        return view('revenue.add', compact('season_id'));
    }

    public function addRevenueSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'season_id' => 'required',
            'quantity' => 'required|numeric',
            'kilo_per_unit' => 'required|numeric',
            'price_per_kilo' => 'required|numeric',
            'total_price' => 'required|numeric',
            'date' => 'required'
        ]);

        DB::table('revenues')->insert([
            'season_id' => $request->season_id,
            'unit' => $request->unit,
            'quantity' => $request->quantity,
            'kilo_per_unit' => $request->kilo_per_unit,
            'price_per_kilo' => $request->price_per_kilo,
            'total_price' => $request->total_price,
            'user_id' => auth()->user()->id,
            'date' => $request->date
        ]);
        return back()->with('record_added', 'Sale has been recorded!');
    }

    public function editRevenue($id)
    {
        $revenue = DB::table('revenues')->where('revenue_id', $id)->first();
        return view('revenue.edit', compact('revenue'));
    }

    public function updateRevenue(Request $request)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|numeric',
            'kilo_per_unit' => 'required|numeric',
            'price_per_kilo' => 'required|numeric',
            'total_price' => 'required|numeric',
            'date' => 'required'
        ]);

        DB::table('revenues')->where('revenue_id', $request->id)->update([
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'kilo_per_unit' => $request->kilo_per_unit,
            'price_per_kilo' => $request->price_per_kilo,
            'total_price' => $request->total_price,
            'date' => $request->date
        ]);
        return back()->with('record_updated', 'Record Updated Successfully!');
    }

    public function deleteRevenue($id){
        DB::table('revenues')->where('revenue_id', $id)->delete();
        return back()->with('record_deleted', 'Record has been deleted!');
    }
}
