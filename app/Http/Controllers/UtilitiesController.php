<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UtilitiesController extends Controller
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
        $soil_types = DB::table('soil_types')->get();
        $plant_categories = DB::table('plant_categories')->get();
        $plant_types = DB::table('plant_types')->get();
        $diseases = DB::table('diseases')->get();

        return view('plants.utilities', compact('soil_types', 'plant_categories', 'plant_types', 'diseases'));
    }

    public function addSoilType(Request $request)
    {
        $validatedData = $request->validate([
            'soil_type_name' => 'required|max:50',
        ]);

        DB::table('soil_types')->insert([
            'soil_type_name' => $request->soil_type_name,
            'description' => $request->description,
            'created_at' => now()
        ]);
        return back()->with('soil_type_added', 'Soil Type has been Added!');
    }

    public function deleteSoilType($id)
    {
        DB::table('soil_types')->where('id', $id)->delete();
        return back()->with('soil_type_deleted', 'Soil Type has been Deleted!');
    }

    public function addPlantCategory(Request $request)
    {
        $validatedData = $request->validate([
            'plant_category_name' => 'required|max:50',
        ]);

        DB::table('plant_categories')->insert([
            'plant_category_name' => $request->plant_category_name,
            'description' => $request->description,
            'created_at' => now()
        ]);
        return back()->with('plant_category_added', 'Plant Category has been Added!');
    }

    public function deletePlantCategory($id)
    {
        DB::table('plant_categories')->where('id', $id)->delete();
        return back()->with('plant_category_deleted', 'Plant Category has been Deleted!');
    }

    public function addPlantType(Request $request)
    {
        $validatedData = $request->validate([
            'plant_type_name' => 'required|max:50',
        ]);

        DB::table('plant_types')->insert([
            'plant_type_name' => $request->plant_type_name,
            'description' => $request->description,
            'created_at' => now()
        ]);
        return back()->with('plant_type_added', 'Plant Type has been Added!');
    }

    public function deletePlantType($id)
    {
        DB::table('plant_types')->where('id', $id)->delete();
        return back()->with('plant_type_deleted', 'Plant Type has been Deleted!');
    }

    public function addDisease(Request $request)
    {
        $validatedData = $request->validate([
            'disease_name' => 'required|max:50',
        ]);

        DB::table('diseases')->insert([
            'disease_name' => $request->disease_name,
            'description' => $request->description,
            'created_at' => now()
        ]);
        return back()->with('disease_added', 'Plant Disease has been Added!');
    }

    public function deleteDisease($id)
    {
        DB::table('diseases')->where('id', $id)->delete();
        return back()->with('disease_deleted', 'Plant Disease has been Deleted!');
    }
}
