<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompareFromLastYield extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $season = DB::table('seasons')->orderBy('start_date', 'DESC')->get(); //Getting the most recent season

        //Every loop stores yield info having index 0 as the most recent season
        for($i=0; $i<2; $i++){
            $yield[$i] = DB::table('yields')->where('season_id', $season[$i]->season_id)->sum('quantity'); //Total yields of a season
        }

        //Passing values to datasets, previous season first followed by the most recent season
        return Chartisan::build()
            ->labels(['Season '.$season[1]->season_id, 'Season '.$season[0]->season_id])
            ->dataset('Yields', [$yield[1], $yield[0] ]);
    }
}