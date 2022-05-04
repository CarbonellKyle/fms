<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:administrator||superadministrator');
    }

    public function adminSettings()
    {
        $farmcode = DB::table('appdata')->where('key', 'farmcode')->first();

        return view('profile.adminSettings', compact('farmcode'));
    }

    public function updateFarmcode(Request $request)
    {
        $user = Auth::user();
        $password_matched = false;

        if (Hash::check($request->password, $user->password)) {
            $password_matched = true;
        }

        //If password is incorrect
        if(!($password_matched)){
            return back()->with('wrong_pass', 'Farmcode change: Failed! The password you entered is incorrect!');
        }

        $validatedData = $request->validate([
            'farmcode' => 'required'
        ]);

        DB::table('appdata')->where('appdata_id', $request->id)->update([
            'value' => $request->farmcode
        ]);
        return back()->with('updated', 'Farmcode has been updated successfully!');
    }

}
