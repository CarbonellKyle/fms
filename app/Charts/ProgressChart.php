<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgressChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */

    public function handler(Request $request): Chartisan
    {
        $season = DB::table('seasons')->orderBy('start_date', 'DESC')->get(); //Getting the most recent season
        $noOfSeasons = count($season);

        //Every loop stores season info having index 0 as the most recent season
        for($i=0; $i<5; $i++){
            $wage = DB::table('labor_wages')->where('season_id', $season[$i]->season_id)->sum('wage');
            $matExpense = DB::table('material_expenses')->where('season_id', $season[$i]->season_id)->sum('cost');
            $tax = DB::table('taxes')->where('season_id', $season[$i]->season_id)->sum('amount');
            $expenses[$i] = round(($wage + $matExpense + $tax),2); //Total expenses of a season
            $revenue[$i] = DB::table('revenues')->where('season_id', $season[$i]->season_id)->sum('total_price'); //Total raw income of a season
            $profit[$i] = round(($revenue[$i] - $expenses[$i]),2); //Profit of a season
        }
        
        //Passing values to datasets, previous season first followed by the most recent season
        return Chartisan::build()
            ->labels(['Season '.$season[4]->season_id, 'Season '.$season[3]->season_id, 'Season '.$season[2]->season_id, 'Season '.$season[1]->season_id, 'Season '.$season[0]->season_id])
            ->dataset('Expenses', [$expenses[4], $expenses[3], $expenses[2], $expenses[1], $expenses[0] ])
            ->dataset('Revenue', [$revenue[4], $revenue[3], $revenue[2], $revenue[1], $revenue[0] ])
            ->dataset('Profit', [$profit[4], $profit[3], $profit[2], $profit[1], $profit[0] ]);
    }
}