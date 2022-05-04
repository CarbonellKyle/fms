<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function currentSeason()
    {
        $isCurrent = false;

        $lastSeason = DB::table('seasons')->orderBy('start_date', 'DESC')->first(); //latest inserted

        //if no seasons yet
        if(empty($lastSeason)){
            return view('guest.currentSeason')->with('isCurrent', false)->with('profit', 0)->with('loss', 0);
        }

        //If last season has ended, therefore, there is no active season
        if($lastSeason->end_date!=null){
            return view('guest.currentSeason')->with('isCurrent', false)->with('profit', 0)->with('loss', 0);
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

        return view('guest.currentSeason', compact('isCurrent', 'lastSeason', 'totalExpenses', 'totalYield', 'totalRevenue', 'profit', 'wage', 'matExpense', 'tax', 'loss'));
    }

    public function history()
    {
        $seasons = DB::table('seasons')->orderBy('start_date', 'DESC')->paginate(5);
        $numRows = count($seasons);
        return view('guest.history', compact('seasons', 'numRows'));
    }

    public function viewSeason($id)
    {
        $season = DB::table('seasons')->where('season_id', $id)->first();

        $wage = DB::table('labor_wages')->where('season_id', $id)->sum('wage');
        $matExpense = DB::table('material_expenses')->where('season_id', $id)->sum('cost');
        $tax = DB::table('taxes')->where('season_id', $id)->sum('amount');
        $totalExpenses = $wage + $matExpense + $tax; //Total expenses of current season

        $totalYield = DB::table('yields')->where('season_id', $id)->sum('quantity'); //Total yield of current season
        $totalRevenue = DB::table('revenues')->where('season_id', $id)->sum('total_price'); //Total raw income of current season
        $profit = $totalRevenue - $totalExpenses; //Profit of current season
        $loss = $profit; //Loss hold the value of profit (more explaination on the view file)
        if($profit<0) {
            $profit = 0; //To output zero instead of negative value
        }

        return view('guest.viewSeason', compact('season', 'totalExpenses', 'totalYield', 'totalRevenue', 'profit', 'wage', 'matExpense', 'tax', 'loss'));
        
    }

    public function progress()
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

        return view('guest.progress', compact('noOfSeasons', 'expenses', 'revenue', 'profit', 'yield'));
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

        return view('guest.lastfive', compact('noOfSeasons', 'expenses', 'revenue', 'profit', 'yield'));
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

        return view('guest.comparefromlast', compact('noOfSeasons', 'expenses', 'revenue', 'profit', 'yield'));
    }
}
