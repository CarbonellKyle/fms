<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaborController extends Controller
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
        $laborers = DB::table('laborers')
        ->join('users', 'laborers.user_id', 'users.id')
        ->select('laborers.*', 'users.name as username')
        ->orderby('laborer_id', 'DESC')->paginate(5);
        $numRows = count($laborers);
        return view('labor.index', compact('laborers', 'numRows'));
    }

    public function addLaborer()
    {
        return view('labor.add');
    }

    public function addLaborerSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);

        DB::table('laborers')->insert([
            'name' => $request->name,
            'address' => $request->address,
            'user_id' => auth()->user()->id
        ]);
        return back()->with('laborer_added', 'A laborer has been added successfully!');
    }

    public function editLaborer($id)
    {
        $laborer = DB::table('laborers')->where('laborer_id', $id)->first();
        return view('labor.edit', compact('laborer'));
    }

    public function updateLaborer(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);

        DB::table('laborers')->where('laborer_id', $request->id)->update([
            'name' => $request->name,
            'address' => $request->address
        ]);
        return back()->with('laborer_updated', 'Record Updated Successfully!');
    }

    public function deleteLaborer($id)
    {
        DB::table('laborers')->where('laborer_id', $id)->delete();
        return back()->with('delete_laborer', 'Record has been deleted!');
    }
}
