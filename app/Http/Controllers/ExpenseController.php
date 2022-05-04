<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExpenseController extends Controller
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
   
    //-- Labor Wage--------------------------------------------------------------------------------
    public function laborwage()
    {
        $lastSeason = DB::table('seasons')->orderBy('start_date', 'DESC')->first();
        //if no seasons yet
        if(empty($lastSeason)){
            return view('expense.laborwage', ['inactive' => 'You need to start a season first!', 'numRows' => 0, 'monthly_count' => 0]);
        }

        //if season is not started yet
        if($lastSeason->end_date!=null){
            return view('expense.laborwage', ['inactive' => 'You need to start a season first!', 'numRows' => 0, 'monthly_count' => 0]);
        }

        $season_id = $lastSeason->season_id;
        
        //Get wage this month only
        $now = Carbon::now();
        $monthly_wages = DB::table('labor_wages')
            ->join('laborers', 'labor_wages.laborer_id', 'laborers.laborer_id') //To get laborer's name
            ->join('users', 'labor_wages.user_id', 'users.id')
            ->select('labor_wages.*', 'laborers.name', 'users.name as username')
            ->where('season_id', $season_id)->whereMonth('date', $now->month)->whereYear('date', $now->year)
            ->orderBy('date', 'DESC')->paginate(5);
        $monthly_count = count($monthly_wages);

        //Get all wage this season
        $wages = DB::table('labor_wages')
            ->join('laborers', 'labor_wages.laborer_id', 'laborers.laborer_id') //To get laborer's name
            ->join('users', 'labor_wages.user_id', 'users.id')
            ->select('labor_wages.*', 'laborers.name', 'users.name as username')
            ->where('season_id', $season_id)->orderBy('date', 'DESC')->paginate(5);
        $numRows = count($wages);

        //Get total wage this season
        $total = DB::table('labor_wages')->where('season_id', $season_id)->sum('wage');

        return view('expense.laborwage', compact('wages', 'numRows', 'monthly_wages', 'monthly_count', 'total', 'now', 'season_id'));
    }

    public function addWage()
    {
        $lastSeason = DB::table('seasons')->orderBy('start_date', 'DESC')->first(); //Current season
        $season_id = $lastSeason->season_id;
        $laborers = DB::table('laborers')->get(); //Pass laborer list to select
        return view('expense.addWage', compact('laborers', 'season_id'));
    }

    public function addWageSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'season_id' => 'required',
            'laborer_id' => 'required',
            'wage' => 'required|numeric',
            'date' => 'required'
        ]);

        DB::table('labor_wages')->insert([
            'season_id' => $request->season_id,
            'laborer_id' => $request->laborer_id,
            'task' => $request->task,
            'wage' => $request->wage,
            'user_id' => auth()->user()->id,
            'date' => $request->date
        ]);
        return back()->with('record_added', 'Payment has been recorded!');
    }

    public function editWage($id)
    {
        $laborers = DB::table('laborers')->get(); //Pass laborer list to select
        $wage = DB::table('labor_wages')
            ->join('laborers', 'labor_wages.laborer_id', 'laborers.laborer_id') //To get laborer's name
            ->select('labor_wages.*', 'laborers.name')
            ->where('labor_wage_id', $id)->first();
        return view('expense.editWage', compact('wage', 'laborers'));
    }

    public function updateWage(Request $request)
    {
        $validatedData = $request->validate([
            'laborer_id' => 'required',
            'wage' => 'required|numeric',
            'date' => 'required'
        ]);

        DB::table('labor_wages')->where('labor_wage_id', $request->id)->update([
            'laborer_id' => $request->laborer_id,
            'task' => $request->task,
            'wage' => $request->wage,
            'date' => $request->date
        ]);
        return back()->with('record_updated', 'Record Updated Successfully!');
    }

    public function deleteWage($id){
        DB::table('labor_wages')->where('labor_wage_id', $id)->delete();
        return back()->with('record_deleted', 'Record has been deleted!');
    }

    //-- Material Expenses----------------------------------------------------------------------------
    public function materials()
    {
        $lastSeason = DB::table('seasons')->orderBy('start_date', 'DESC')->first();
        //if no seasons yet
        if(empty($lastSeason)){
            return view('expense.materials', ['inactive' => 'You need to start a season first!', 'numRows' => 0, 'monthly_count' => 0]);
        }

        //if season is not started yet
        if($lastSeason->end_date!=null){
            return view('expense.materials', ['inactive' => 'You need to start a season first!', 'numRows' => 0, 'monthly_count' => 0]);
        }

        $season_id = $lastSeason->season_id;

        //Get material expenses this month only
        $now = Carbon::now();
        $monthly_expenses = DB::table('material_expenses')
        ->join('users', 'material_expenses.user_id', 'users.id')
        ->select('material_expenses.*', 'users.name as username')
        ->where('season_id', $season_id)->whereMonth('date', $now->month)->whereYear('date', $now->year)
        ->orderBy('date', 'DESC')->paginate(5);
        $monthly_count = count($monthly_expenses);


        //Get all material expenses this season
        $expenses = DB::table('material_expenses')
        ->join('users', 'material_expenses.user_id', 'users.id')
        ->select('material_expenses.*', 'users.name as username')
        ->where('season_id', $season_id)->orderBy('date', 'DESC')->paginate(5);
        $numRows = count($expenses);

        //Get total material expenses this season
        $total = DB::table('material_expenses')->where('season_id', $season_id)->sum('cost');

        return view('expense.materials', compact('expenses', 'numRows', 'monthly_expenses', 'monthly_count', 'total', 'now', 'season_id'));
    }

    public function addMatExpense()
    {
        $lastSeason = DB::table('seasons')->orderBy('start_date', 'DESC')->first(); //current season
        $season_id = $lastSeason->season_id;
        return view('expense.addMatExpense', compact('season_id'));
    }

    public function addMatExpenseSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'season_id' => 'required',
            'name' => 'required',
            'quantity' => 'required|numeric',
            'price_per_unit' => 'required|numeric',
            'cost' => 'required|numeric',
            'date' => 'required'
        ]);

        DB::table('material_expenses')->insert([
            'season_id' => $request->season_id,
            'name' => $request->name,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price_per_unit' => $request->price_per_unit,
            'cost' => $request->cost,
            'user_id' => auth()->user()->id,
            'date' => $request->date
        ]);
        return back()->with('record_added', 'Purchase has been recorded!');
    }

    public function editMatExpense($id)
    {
        $expense = DB::table('material_expenses')->where('material_expense_id', $id)->first();
        return view('expense.editMatExpense', compact('expense'));
    }

    public function updateMatExpense(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric',
            'price_per_unit' => 'required|numeric',
            'cost' => 'required|numeric',
            'date' => 'required'
        ]);

        DB::table('material_expenses')->where('material_expense_id', $request->id)->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price_per_unit' => $request->price_per_unit,
            'cost' => $request->cost,
            'date' => $request->date
        ]);
        return back()->with('record_updated', 'Record Updated Successfully!');
    }

    public function deleteMatExpense($id){
        DB::table('material_expenses')->where('material_expense_id', $id)->delete();
        return back()->with('record_deleted', 'Record has been deleted!');
    }

    //-- Tax Payment----------------------------------------------------------------------------------
    public function tax()
    {
        $lastSeason = DB::table('seasons')->orderBy('start_date', 'DESC')->first();
        //if no seasons yet
        if(empty($lastSeason)){
            return view('expense.tax', ['inactive' => 'You need to start a season first!', 'numRows' => 0, 'monthly_count' => 0]);
        }

        //if season is not started yet
        if($lastSeason->end_date!=null){
            return view('expense.tax', ['inactive' => 'You need to start a season first!', 'numRows' => 0, 'monthly_count' => 0]);
        }

        $season_id = $lastSeason->season_id;
        
        //Get tax this month only
        $now = Carbon::now();
        $monthly_taxes = DB::table('taxes')
        ->join('users', 'taxes.user_id', 'users.id')
        ->select('taxes.*', 'users.name as username')
        ->where('season_id', $season_id)->whereMonth('date', $now->month)->whereYear('date', $now->year)
        ->orderBy('date', 'DESC')->paginate(5);
        $monthly_count = count($monthly_taxes);

        //Get all tax this season
        $taxes = DB::table('taxes')
        ->join('users', 'taxes.user_id', 'users.id')
        ->select('taxes.*', 'users.name as username')
        ->where('season_id', $season_id)->orderBy('date', 'DESC')->paginate(5);
        $numRows = count($taxes);

        //Get total tax this season
        $total = DB::table('taxes')->where('season_id', $season_id)->sum('amount');

        return view('expense.tax', compact('taxes', 'numRows', 'monthly_taxes', 'monthly_count', 'total', 'now', 'season_id'));
    }

    public function addTaxExpense()
    {
        $lastSeason = DB::table('seasons')->orderBy('start_date', 'DESC')->first(); //current season
        $season_id = $lastSeason->season_id;
        return view('expense.addTaxExpense', compact('season_id'));
    }

    public function addTaxExpenseSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'season_id' => 'required',
            'name' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required'
        ]);

        DB::table('taxes')->insert([
            'season_id' => $request->season_id,
            'name' => $request->name,
            'amount' => $request->amount,
            'user_id' => auth()->user()->id,
            'date' => $request->date
        ]);
        return back()->with('record_added', 'Tax payment has been recorded!');
    }

    public function editTaxExpense($id)
    {
        $tax = DB::table('taxes')->where('tax_id', $id)->first();
        return view('expense.editTaxExpense', compact('tax'));
    }

    public function updateTaxExpense(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required'
        ]);

        DB::table('taxes')->where('tax_id', $request->id)->update([
            'name' => $request->name,
            'amount' => $request->amount,
            'date' => $request->date
        ]);
        return back()->with('record_updated', 'Record Updated Successfully!');
    }

    public function deleteTaxExpense($id){
        DB::table('taxes')->where('tax_id', $id)->delete();
        return back()->with('record_deleted', 'Record has been deleted!');
    }
}
