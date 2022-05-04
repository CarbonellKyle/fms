<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrentYield extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */

    public function handler(Request $request): Chartisan
    {
        $lastSeason = DB::table('seasons')->orderBy('start_date', 'DESC')->first(); //Getting the most recent season

        $yield = DB::table('yields')->where('season_id', $lastSeason->season_id)->sum('quantity'); //Season's total yields


        return Chartisan::build()
            ->labels(['CurrentSeason'])
            ->dataset('Current Yield', [$yield]);
    }
}