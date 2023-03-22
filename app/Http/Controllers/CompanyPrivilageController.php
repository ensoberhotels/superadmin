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
use App\MenuMaster;
use App\CompanyMaster;
use App\CompanyPrivilage;
use PDF;
use Validator;
use Illuminate\Support\Facades\Session;

class CompanyPrivilageController extends Controller
{
	

	public function index(){
		$comp_priv=CompanyPrivilage::select('company_id','module_id','login_type')->orderBy('id','DESC')->with('getCompany')->with('getModule')->distinct('module_id')->paginate(10);
		//dd($comp_priv);
		return view('companyprivilage.index',compact('comp_priv'));
	}
	public function create(){
		$company=CompanyMaster::get();
		$module=ModuleMaster::get();
		return view('companyprivilage.create',compact('company','module'));	
	}
	public function loginTyp(Request $request){
		$module=MenuMaster::select('module')->where('login_type',$request->login_typ)->pluck('module')->toArray();
		$file_module=ModuleMaster::whereIn('id',$module)->get();
		$data='<select class="form-control" id="module" name="module[]" multiple >
		';
		foreach($file_module as $file_module){
			$data .= '<option value="'.$file_module->id.'">'.$file_module->title.'</option>';
		}
		$data .='</select>';
		return response()->json(['status' => 1, 'msg' => 'Data Fetch Successfully!', 'data' => $data]);
	}
	public function getTableData(Request $request){
		if(gettype($request->module) == 'string'){
			$module=MenuMaster::where('module',$request->module)->orderBy('id','DESC')->get();
		}else{
			$module=[];
			for($i=0;$i<count($request->module);$i++){
				$module[]=$request->module[$i];
			}
			$module=MenuMaster::whereIn('module',$module)->orderBy('id','DESC')->get();
		}
		
		$record='';
		$i=1;
		if(count($module)>0){
			foreach($module as $modules){
				$records=CompanyPrivilage::where('menu_id',$modules->id)->first();
				if(@$records->menu_id == $modules->id){
					if($records->permission == 'Y'){
						$yes_no='Y';
						$checked='checked';
					}else{
						$yes_no='N';
						$checked='';
					}
					$record .= '<tr>
						<td>'.$i.'</td>
						<td>'.$modules->name.'<input type="hidden" name="menu_id[]" value="'.$modules->id.'"></td>
						<td>
						<input type="checkbox" class="custome_checkbox chk" style="height: auto !important;" name="yes_no[]" id="yes_no_'.$i.'" '.$checked.' onchange="check('.$i.')" value="'.$yes_no.'">
						<input type="hidden" name="yes_nos[]" class="chks" id="yes_nos_'.$i.'" value="'.$yes_no.'"></td>
					</tr>';
				}else{
					$record .= '<tr>
						<td>'.$i.'</td>
						<td>'.$modules->name.'<input type="hidden" name="menu_id[]" value="'.$modules->id.'"></td>
						<td>
						<input type="checkbox" class="custome_checkbox chk" style="height: auto !important;" name="yes_no[]" id="yes_no_'.$i.'" onchange="check('.$i.')" value="N">
						<input type="hidden" name="yes_nos[]" class="chks" id="yes_nos_'.$i.'" value="N"></td>
					</tr>';
				}
				
				$i++;

			}
			return response()->json(['status' => 1, 'msg' => 'Data Fetch Successfully!', 'data' => $record]);
		}else{
			return response()->json(['status' => 0, 'msg' => 'Data not Found!', 'data' => '']);
		}
	}
	public function save(Request $request){
		//dd($request->all());
		\DB::beginTransaction();
		// try{
            if(count($request->yes_nos)>0){
        		for($i=0;$i<count($request->yes_nos);$i++){
        			$post=[
		            	'company_id'	=>	$request->company_id,
		            	'menu_id'		=>	$request->menu_id[$i],
		            	'permission'	=> 	$request->yes_nos[$i],
		            	'created_by'	=>	'Admin',
		            	'login_type'	=>	$request->login_typ,
		            	'module_id'		=>	$request->module[]
		            ];
		            dd($post);
		            $save=CompanyPrivilage::insert($post);
        		}
        	}
            

            if($save){
            	\DB::commit();
            	//dd($save);
            	return response()->json(['status' => 1, 'msg' => 'Added Successfully', 'data' => '']);
            }else{
            	\DB::rollback();
            	return response()->json(['status' => 0, 'msg' => 'Data not save!', 'data' => '']);
            }
            
		// }catch(Exception $e){
		// 	\DB::rollback();
  //           return response()->json(['status' => 0, 'msg' => $e->getMessage(), 'data' => '']);
		// }
	}
	public function edit($id){
		$record=CompanyPrivilage::where('module_id',$id)->first();
		$company=CompanyMaster::get();
		$module=ModuleMaster::get();
		return view('companyprivilage.update',compact('company','module','record'));
	}
	public function update(Request $request){
		//dd($request->all());
		\DB::beginTransaction();
		try{
            if(count($request->yes_nos)>0){
        		for($i=0;$i<count($request->yes_nos);$i++){
        			$post=[
		            	// 'company_id'	=>	$request->company_id,
		            	// 'menu_id'		=>	$request->menu_id[$i],
		            	'permission'	=> 	$request->yes_nos[$i],
		            	'updated_by'	=>	'1',
		            	// 'login_type'	=>	$request->login_typ,
		            	// 'module_id'		=>	$request->module
		            ];
		            $save=CompanyPrivilage::where('company_id',$request->company_id)->where('module_id',$request->module)->where('login_type',$request->login_typ)->where('menu_id',$request->menu_id[$i])->update($post);
        		}
        	}
            

            if($save){
            	\DB::commit();
            	//dd($save);
            	return response()->json(['status' => 1, 'msg' => 'Update Successfully', 'data' => '']);
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