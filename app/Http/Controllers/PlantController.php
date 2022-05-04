<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlantController extends Controller
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
        $plants = DB::table('plants')
        ->join('plant_types', 'plants.type_id', 'plant_types.id')
        ->select('plants.*', 'plant_types.plant_type_name')
        ->paginate(10);

        return view('plants.index', compact('plants'));
    }

    public function addPlant()
    {
        $plant_categories = DB::table('plant_categories')->get();
        $plant_types = DB::table('plant_types')->get();

        return view('plants.add', compact('plant_categories', 'plant_types'));
    }

    public function addPlantSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'plant_name' => 'required|max:50',
            'scientific_name' => 'max:100',
            'category_id' => 'required|numeric',
            'type_id' => 'required|numeric',
            'noOfMonthsHarvestable' => 'required|numeric',
        ]);

        DB::table('plants')->insert([
            'plant_name' => $request->plant_name,
            'scientific_name' => $request->scientific_name,
            'category_id' => $request->category_id,
            'type_id' => $request->type_id,
            'variety' => $request->variety,
            'noOfMonthsHarvestable' => $request->noOfMonthsHarvestable,
            'description' => $request->description,
            'created_at' => now()
        ]);
        return redirect('/plants')->with('record_added', 'A plant has been added!');
    }

    public function editPlant($id)
    {
        $plant_categories = DB::table('plant_categories')->get();
        $plant_types = DB::table('plant_types')->get();

        $plant = DB::table('plants')
            ->join('plant_categories', 'plants.category_id', 'plant_categories.id') //To Category Name
            ->join('plant_types', 'plants.type_id', 'plant_types.id') //To Category Name
            ->select('plants.*', 'plant_categories.plant_category_name', 'plant_types.plant_type_name')
            ->where('plants.id', $id)->first();

        return view('plants.edit', compact('plant', 'plant_categories', 'plant_types'));
    }

    public function deletePlant($id){
        DB::table('plants')->where('id', $id)->delete();
        return back()->with('record_deleted', 'Record has been deleted!');
    }
}
