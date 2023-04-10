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
use App\CompanyMaster;
use PDF;
use Validator;
use Illuminate\Support\Facades\Session;

class CompanyMasterController extends Controller
{
	public function index(){
		$company=CompanyMaster::orderBy('id','DESC')->paginate(10);
		//dd($company);
		return view('companymaster.index',compact('company'));
	}
	public function create(){
		return view('companymaster.create');	
	}
	public function save(Request $request){
		//dd($request->all());
		\DB::beginTransaction();
		try{
			$validator = \Validator::make($request->all(), [ 
            	'company_name'=>'required',
            	// 'company_gstin'=>'required',
            	'company_type'=>'required',
            	'company_mobile'=>'required',
            	'company_email'=>'required|email|unique:sua_company_master,email',
            ]);
            if ($validator->fails()) { 
                return response()->json(['status' => 0, 'msg' => 'Error: '.$validator->errors()->first(), 'data' => '']);
            }
             if($request->file('company_logo')){
             	$name = time().'_'.$request->file('company_logo')->getClientOriginalName();   
             	//dd($name);   
                $destinationPath = public_path('/asset/company_logo');
                $request->file('company_logo')->move($destinationPath, $name);
             }
            	$CompanyMaster=new CompanyMaster();
            	$CompanyMaster->company_name	=	$request->company_name;
					$CompanyMaster->gstin			=	$request->company_gstin;
					$CompanyMaster->company_type	=	$request->company_type;
					$CompanyMaster->mobile		=	$request->company_mobile;
					$CompanyMaster->email			=	$request->company_email;
					$CompanyMaster->website		=	$request->company_web;
					$CompanyMaster->description	=	$request->company_desc;
					$CompanyMaster->logo			=	(isset($name) ? $name : '');
					$CompanyMaster->address		=	$request->company_add;
					$CompanyMaster->no_of_user	= $request->no_of_user;
            	$CompanyMaster->save();

            //dd($post);
            //::insert($post);
            $data=[
            	'user'	=>	$request->username,
            	'password'		=>	$request->password,
            	'user_type'=>'CA',
            	'comp_id'=>$CompanyMaster->id
            ];
            $message= '<table>
            	<tr>
            		<td>Username</td>
            		<td>'.$request->username.'</td>
            	</tr>
            	<tr>
            		<td>Password</td>
            		<td>'.$request->password.'</td>
            	</tr>
            </table>';
            $from =$request->username;
            $to =$request->username;
            $subject = 'Your Login Credential';
            $pdf_name='';$ccemail='';
            $sav=Admin::insert($data);
            $this->send($message, $subject, $from, $to, $pdf_name='', $ccemail='');
            if($sav){
            	\DB::commit();
            	//dd($save);
            	return response()->json(['status' => 1, 'msg' => 'Added Successfully', 'data' => $data]);
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
		$record=CompanyMaster::where('id',$id)->first();
		return view('companymaster.update',compact('record'));	
	}
	public function update(Request $request){
		//dd($request->all());
		\DB::beginTransaction();
		try{
			$validator = \Validator::make($request->all(), [ 
            	'company_name'=>'required',
            	//'company_gstin'=>'required',
            	'company_type'=>'required',
            	'company_mobile'=>'required',
            	'company_email'=>'required',
            ]);
            if ($validator->fails()) { 
                return response()->json(['status' => 0, 'msg' => 'Error: '.$validator->errors()->first(), 'data' => '']);
            }
             if($request->file('company_logo')){
             	$name = time().'_'.$request->file('company_logo')->getClientOriginalName();   
             	//dd($name);   
                $destinationPath = public_path('/asset/company_logo');
                $request->file('company_logo')->move($destinationPath, $name);
             }else{
             	$record=CompanyMaster::where('id',$request->id)->first();
             	$name =$record->logo;
             }
            $post=[
            	'company_name'	=>	$request->company_name,
            	'gstin'			=>	$request->company_gstin,
            	'company_type'	=>	$request->company_type,
            	'mobile'		=>	$request->company_mobile,
            	'email'			=>	$request->company_email,
            	'website'		=>	$request->company_web,
            	'description'	=>	$request->company_desc,
            	'logo'			=>	(isset($name) ? $name : ''),
            	'address'		=>	$request->company_add,
            	'no_of_user'	=> $request->no_of_user
            ];
            //dd($post);
            $save=CompanyMaster::where('id',$request->id)->update($post);
            // $data=[
            // 	'user'	=>	$request->company_email,
            // 	'password'		=>	'123456',
            // 	'user_type'=>'CA'
            // ];
            // $sav=Admin::insert($data);
            if($save){
            	\DB::commit();
            	//dd($save);
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
		$del=CompanyMaster::where('id',$request->id)->delete();
		if($del){
			return response()->json(['status' => 1, 'msg' => 'Data Delete Successfully!', 'data' => '']);
		}else{
			return response()->json(['status' => 0, 'msg' => 'Something Went Wrong!', 'data' => '']);
		}
	}
}