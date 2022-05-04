<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
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
        $batches = DB::table('batches')
        ->join('plants', 'batches.plant_id', 'plants.id')
        ->select('batches.*', 'plants.plant_name')
        ->paginate(10);
        return view('batch.index', compact('batches'));
    }

    public function addBatch()
    {
        $plants = DB::table('plants')->get();
        return view('batch.add', compact('plants'));
    }

    public function addBatchSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'startOfFarm' => 'required',
            'quantity' => 'required|numeric',
            'measurement' => 'required|max:50',
            'expectedHarvestPeriodTo' => 'required',
            'expectedHarvestPeriodFrom' => 'required'
        ]);

        DB::table('batches')->insert([
            'plant_id' => $request->plant_id,
            'startOfFarm' => $request->startOfFarm,
            'quantity' => $request->quantity,
            'measurement' => $request->measurement,
            'expectedHarvestPeriodTo' => $request->expectedHarvestPeriodTo,
            'expectedHarvestPeriodFrom' => $request->expectedHarvestPeriodFrom,
            'created_at' => now()
        ]);
        return redirect('/batch')->with('record_added', 'A batch has been added!');
    }

    public function viewBatch($id)
    {
        $batch = DB::table('batches')
        ->join('plants', 'batches.plant_id', 'plants.id')
        ->select('batches.*', 'plants.*')
        ->where('batches.id', $id)->first();
        return view('batch.view', compact('batch'));
    }

    //Batch Updates-------------------------------------------------------------
    public function batchProgress($id)
    {
        $batch = DB::table('batches')
        ->join('plants', 'batches.plant_id', 'plants.id')
        ->select('batches.*', 'plants.*')
        ->where('batches.id', $id)->first();
        return view('batch.progress', compact('batch'));
    }
    public function updateBatchProgress(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'currentStage' => 'required|max:50',
            'price' => 'required|numeric',
            'quantityLoss' => 'required|numeric',
        ]);

        DB::table('batches')->where('id', $request->id)->update([
            'currentStage' => $request->currentStage,
            'price' => $request->price,
            'quantityLoss' => $request->quantityLoss,
            'remarks' => $request->remarks,
            'updated_at' => now()
        ]);

        return back()->with('progress_updated', 'Progress Updated Successfully!');
    }

    public function batchActivities($id)
    {
        $batch = DB::table('batches')
        ->join('plants', 'batches.plant_id', 'plants.id')
        ->select('batches.*', 'plants.*')
        ->where('batches.id', $id)->first();

        $activities = DB::table('activities')->where('batch_id', $id)->get();

        return view('batch.activities', compact('batch', 'activities'));

    }

    public function batchDiseases($id)
    {
        $batch = DB::table('batches')
        ->join('plants', 'batches.plant_id', 'plants.id')
        ->select('batches.*', 'plants.*')
        ->where('batches.id', $id)->first();

        $diseases = DB::table('diseases')->get();

        $batch_diseases = DB::table('batch_disease')
        ->join('diseases', 'batch_disease.disease_id', 'diseases.id')
        ->select('batch_disease.*', 'diseases.disease_name')
        ->where('batch_disease.batch_id', $id)->get();

        return view('batch.diseases', compact('batch', 'diseases', 'batch_diseases'));
    }

    public function addBatchDisease(Request $request)
    {
        $validatedData = $request->validate([
            'disease_id' => 'required|numeric',
            'noOfPlantsAffected' => 'required|numeric',
            'status' => 'required|max:50',
        ]);

        DB::table('batch_disease')->insert([
            'batch_id' => $request->batch_id,
            'disease_id' => $request->disease_id,
            'noOfPlantsAffected' => $request->noOfPlantsAffected,
            'status' => $request->status,
            'created_at' => now()
        ]);

        return back()->with('disease_added', 'Plant Disease has been Added!');
    }

    public function deleteBatchDisease($id)
    {
        DB::table('batch_disease')->where('id', $id)->delete();
        return back()->with('disease_deleted', 'Plant Disease has been Deleted!' . $id);
    }

    public function addBatchActivity(Request $request)
    {
        $validatedData = $request->validate([
            'batch_id' => 'required',
            'activity_name' => 'required|max:50',
        ]);

        DB::table('activities')->insert([
            'batch_id' => $request->batch_id,
            'activity_name' => $request->activity_name,
            'created_at' => now()
        ]);

        return back()->with('activity_added', 'Activity has been Added!');
    }
}
