<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\AdminRequest;
use App\grievance;
use Storage;

class grievanceController extends Controller
{   
    public function index(){
        $grievances=grievance::orderBy('id','DESC')->paginate(5);
		return view('grievance.index',compact('grievances'));
    }

    public function update(request $request){
        // dd($request->all());
		\DB::beginTransaction();
		try{
            $data = grievance::where('id', $request->id)->first();
            if ($data) {
                $save = grievance::where('id', $request->id)->update(['status' => $request->status]);
                if ($save) {
                    \DB::commit();
                    return response()->json(['status' => 1, 'msg' => "Grievance ID-: $request->id updated successfully", 'data' => $data]);
                } else {
                    \DB::rollback();
                    return response()->json(['status' => 0, 'msg' => 'Error while updating grievance !', 'data' => '']);
                }
            }else {
                \DB::rollback();
                return response()->json(['status' => 0, 'msg' => 'Error while updating grievance !', 'data' => '']);
            }
        }catch(Exception $e){
			\DB::rollback();
            return response()->json(['status' => 0, 'msg' => 'Error while updating grievance !', 'data' => '']);
		}
    }
}
