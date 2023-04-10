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
}
