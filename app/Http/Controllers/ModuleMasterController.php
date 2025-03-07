<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse; 

use DB;
use Mail;
use PHPMailer\PHPMailer;
use Storage;
use View;
use App\Admin;
// use App\Vender;
// use App\Hotel;
// use App\Operator;
// use App\HotelGallery;
// use App\HotelAmenity;
// use App\Amenity;
// use App\RoomCategory;
// use App\HotelSeasonRate;
// use App\PaidAmenity;
// use App\HotelGroupSeasonRate;
// use App\Lead;
// use App\Quotation;
// use App\Sale;
// use App\Contacts;
// use App\AdminRequest;
// use App\AssignContacts;
// use App\BulkEmailSendReport;
// use App\BulkEmailSend;
use App\EmailTemplat;
use App\EmailCampaign;
use App\EmailList;
use App\SMTPEmail;
use App\RoomBookedDetails;
use App\WebsiteEnquiry;
use App\ModuleMaster;
use PDF;
use Validator;
use Illuminate\Support\Facades\Session;

class ModuleMasterController extends Controller
{
	

	public function index(){
		$module=ModuleMaster::orderBy('id','DESC')->paginate(10);
		//dd($company);
		return view('modulemaster.index',compact('module'));
	}
	public function create(){
		return view('modulemaster.create');	
	}
	public function save(Request $request){
		//dd($request->all());
		\DB::beginTransaction();
		try{
			$validator = \Validator::make($request->all(), [ 
            	'title'=>'required',
            	'description'=>'required',
            ]);
            if ($validator->fails()) { 
                return response()->json(['status' => 0, 'msg' => 'Error: '.$validator->errors()->first(), 'data' => '']);
            }
            $post=[
            	'title'			=>	$request->title,
            	'description'	=>	$request->description,
            	'status'		=> 	$request->status
            ];
            //dd($post);
            $save=ModuleMaster::insert($post);

            if($save){
            	\DB::commit();
            	//dd($save);
            	return response()->json(['status' => 1, 'msg' => 'Added Successfully', 'data' => '']);
            }else{
            	\DB::rollback();
            	return response()->json(['status' => 0, 'msg' => 'Data not save!', 'data' => '']);
            }
            
		}catch(Exception $e){
			\DB::rollback();
            return response()->json(['status' => 0, 'msg' => $e->getMessage(), 'data' => '']);
		}
	}
	public function delete(Request $request){
		$del=ModuleMaster::where('id',$request->id)->delete();
		if($del){
			return response()->json(['status' => 1, 'msg' => 'Data Delete Successfully!', 'data' => '']);
		}else{
			return response()->json(['status' => 0, 'msg' => 'Something Went Wrong!', 'data' => '']);
		}
	}
}