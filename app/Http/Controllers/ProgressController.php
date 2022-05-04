<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
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
        $seasons = DB::table('seasons')->get();
        $noOfSeasons = count($seasons);

        $lastSeason = DB::table('seasons')->orderBy('start_date', 'DESC')->first(); //Getting the most recent season

        $wage = DB::table('labor_wages')->where('season_id', $lastSeason->season_id)->sum('wage');
        $matExpense = DB::table('material_expenses')->where('season_id', $lastSeason->season_id)->sum('cost');
        $tax = DB::table('taxes')->where('season_id', $lastSeason->season_id)->sum('amount');
        $expenses = round(($wage + $matExpense + $tax),2); //Season's total expenses
        $yield = DB::table('yields')->where('season_id', $lastSeason->season_id)->sum('quantity'); //Season's total yields
        $revenue = DB::table('revenues')->where('season_id', $lastSeason->season_id)->sum('total_price'); //Season's total raw income
        $profit = round(($revenue - $expenses),2); //Season's profit

        return view('progress.index', compact('noOfSeasons', 'expenses', 'revenue', 'profit', 'yield'));
    }

    public function lastfive()
    {
        $seasons = DB::table('seasons')->get();
        $noOfSeasons = count($seasons);

        $season = DB::table('seasons')->orderBy('start_date', 'DESC')->get(); //Getting the most recent season

        //Every loop stores season info having index 0 as the most recent season
        for($i=0; $i<5; $i++){
            $wage = DB::table('labor_wages')->where('season_id', $season[$i]->season_id)->sum('wage');
            $matExpense = DB::table('material_expenses')->where('season_id', $season[$i]->season_id)->sum('cost');
            $tax = DB::table('taxes')->where('season_id', $season[$i]->season_id)->sum('amount');
            $expenses[$i] = round(($wage + $matExpense + $tax),2); //Total expenses of a season
            $yield[$i] = DB::table('yields')->where('season_id', $season[$i]->season_id)->sum('quantity'); //Total yields of a season
            $revenue[$i] = DB::table('revenues')->where('season_id', $season[$i]->season_id)->sum('total_price'); //Total raw income of a season
            $profit[$i] = round(($revenue[$i] - $expenses[$i]),2); //Profit of a season
        }

        return view('progress.lastfive', compact('noOfSeasons', 'expenses', 'revenue', 'profit', 'yield'));
    }

    public function comparefromlast()
    {
        $seasons = DB::table('seasons')->get();
        $noOfSeasons = count($seasons);

        $season = DB::table('seasons')->orderBy('start_date', 'DESC')->get(); //Getting the most recent season

        //Every loop stores season info having index 0 as the most recent season
        for($i=0; $i<2; $i++){
            $wage = DB::table('labor_wages')->where('season_id', $season[$i]->season_id)->sum('wage');
            $matExpense = DB::table('material_expenses')->where('season_id', $season[$i]->season_id)->sum('cost');
            $tax = DB::table('taxes')->where('season_id', $season[$i]->season_id)->sum('amount');
            $expenses[$i] = round(($wage + $matExpense + $tax),2); //Total expenses of a season
            $yield[$i] = DB::table('yields')->where('season_id', $season[$i]->season_id)->sum('quantity'); //Total yields of a season
            $revenue[$i] = DB::table('revenues')->where('season_id', $season[$i]->season_id)->sum('total_price'); //Total raw income of a season
            $profit[$i] = round(($revenue[$i] - $expenses[$i]),2); //Profit of a season
        }

        return view('progress.comparefromlast', compact('noOfSeasons', 'expenses', 'revenue', 'profit', 'yield'));
    }
}
