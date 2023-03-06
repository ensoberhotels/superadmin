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
use App\MenuMaster;
use App\ModuleMaster;
use PDF;
use Validator;
use Illuminate\Support\Facades\Session;

class MenuMasterController extends Controller
{
	public function index(){
		$menu=MenuMaster::orderBy('id','DESC')->paginate(10);
		return view('menumaster.index',compact('menu'));
	}
	public function create(){
		$module=ModuleMaster::where('status','Active')->get();
		$parent_menu=MenuMaster::where('type','MENU')->where('status','Active')->get();
		return view('menumaster.create',compact('module','parent_menu'));	
	}
	public function save(Request $request){
		\DB::beginTransaction();
		try{
			$validator = \Validator::make($request->all(), [ 
            	'module'=>'required',
            	'name'=>'required',
            	'menu_type'=>'required',
            	'short_name'=>'required',
            	'full_name'=>'required',
            	'path'=>'required',
            	'f_icon'=>'required',
            ]);
            if ($validator->fails()) { 
                return response()->json(['status' => 0, 'msg' => 'Error: '.$validator->errors()->first(), 'data' => '']);
            }
            $post=[
            	'login_type'	=>	$request->login_type,
            	'name'			=>	$request->name,
            	'sname'			=>	$request->short_name,
            	'fname'			=>	$request->full_name,
            	'module'		=>	$request->module,
            	'status'		=>	$request->status,
            	'icon'			=>	$request->f_icon,
            	'path'			=>	$request->path,
            	'tcode'			=>	$request->t_code,
            	'display_order'	=>	$request->display_order,
            	'type'			=>  $request->menu_type,
            	'parent_menu_id'=>  $request->parent_menu,
            ];
            $save=MenuMaster::insert($post);
            if($save){
            	\DB::commit();
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
	public function edit($id){
		$record=MenuMaster::where('id',$id)->first();
		$module=ModuleMaster::where('status','Active')->get();
		$parent_menu=MenuMaster::where('type','MENU')->where('status','Active')->get();
		return view('menumaster.update',compact('record','module','parent_menu'));	
	}
	public function update(Request $request){
		\DB::beginTransaction();
		try{
			$validator = \Validator::make($request->all(), [ 
            	'module'=>'required',
            	'name'=>'required',
            	'menu_type'=>'required',
            	'short_name'=>'required',
            	'full_name'=>'required',
            	'path'=>'required',
            	'f_icon'=>'required',
            ]);
            if ($validator->fails()) { 
                return response()->json(['status' => 0, 'msg' => 'Error: '.$validator->errors()->first(), 'data' => '']);
            }
            $post=[
            	'login_type'	=>	$request->login_type,
            	'name'			=>	$request->name,
            	'sname'			=>	$request->short_name,
            	'fname'			=>	$request->full_name,
            	'module'		=>	$request->module,
            	'status'		=>	$request->status,
            	'icon'			=>	$request->f_icon,
            	'path'			=>	$request->path,
            	'tcode'			=>	$request->t_code,
            	'display_order'	=>	$request->display_order,
            	'type'			=>	$request->menu_type,
            	'parent_menu_id'=>	$request->parent_menu,
            ];
            $save=MenuMaster::where('id',$request->id)->update($post);
            if($save){
            	\DB::commit();
            	return response()->json(['status' => 1, 'msg' => 'Updated Successfully', 'data' => '']);
            }else{
            	\DB::rollback();
            	return response()->json(['status' => 0, 'msg' => 'Data not update!', 'data' => '']);
            }
		}catch(Exception $e){
			\DB::rollback();
            return response()->json(['status' => 0, 'msg' => $e->getMessage(), 'data' => '']);
		}
	}
	public function delete(Request $request){
		$del=MenuMaster::where('id',$request->id)->delete();
		if($del){
			return response()->json(['status' => 1, 'msg' => 'Data Delete Successfully!', 'data' => '']);
		}else{
			return response()->json(['status' => 0, 'msg' => 'Something Went Wrong!', 'data' => '']);
		}
	}
}