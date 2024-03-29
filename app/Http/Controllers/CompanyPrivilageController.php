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
		//$comp_priv=CompanyPrivilage::select('company_id','module_id','login_type')->orderBy('id','DESC')->with('getCompany')->with('getModule')->distinct('company_id')->get();
		$comp_priv=CompanyPrivilage::select('company_id','login_type')->orderBy('id','DESC')->with('getCompany')->distinct('company_id')->get();
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
		$record=CompanyPrivilage::where('company_id',$request->company_id)->where('login_type',$request->login_typ)->with('getCompany')->get();
		if(count($record)>0){
			if($request->login_typ=='O'){
				$login_typ='Operator';
			}else{
				$login_typ='Admin';
			}
			$records ='<tr>
							<td colspan="3">'.$record[0]->getCompany->company_name.'  Company '.$login_typ. ' Privilage Already Exist!</td></tr>';
			return response()->json(['status' => 1, 'msg' => 'Data Fetch Successfully!', 'data' => $records]);
		}else{
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
							<td style="text-align: left;">'.$modules->name.'<input type="hidden" name="menu_id[]" value="'.$modules->id.'"></td>
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
		
	}
	public function save(Request $request){
		// dd($request->all());
		\DB::beginTransaction();
		CompanyPrivilage::where('company_id', $request->company_id)->where('login_type', $request->login_typ)->delete();
		try{
			// if(count($request->module)>0){
        	// 	for($i=0;$i<count($request->module);$i++){
			// 		if(count($request->yes_nos)>0){
			// 			for($j=0;$j<count($request->yes_nos);$j++){
			// 				$menu	=	MenuMaster::where('module', $request->module[$i])->where('id', $request->menu_id[$j])->first();
			// 				if ($menu) {
			// 					$post=[
			// 						'company_id'	=>	$request->company_id,
			// 						'menu_id'		=>	$request->menu_id[$j],
			// 						'permission'	=> 	$request->yes_nos[$j],
			// 						'created_by'	=>	'Admin',
			// 						'updated_by'	=>	'Admin',
			// 						'login_type'	=>	$request->login_typ,
			// 						'module_id'		=>	$request->module[$i]
			// 					];
			// 					// dd($post);
			// 					$save=CompanyPrivilage::insert($post);
			// 				}
			// 			}
			// 		}
        	// 	}
        	// }
			if(count($request->yes_nos)>0){
				for($j=0;$j<count($request->yes_nos);$j++){
					$menu	=	MenuMaster::where('id', $request->menu_id[$j])->first();
					if ($menu) {
						$post=[
							'company_id'	=>	$request->company_id,
							'menu_id'		=>	$request->menu_id[$j],
							'permission'	=> 	$request->yes_nos[$j],
							'created_by'	=>	'Admin',
							'updated_by'	=>	'Admin',
							'login_type'	=>	$request->login_typ,
							'module_id'		=>	$menu->module,
							'menu_flag' 	=>	'Y',
						];
						CompanyPrivilage::insert($post);
					}
				}
			}
			\DB::commit();
			return response()->json(['status' => 1, 'msg' => 'Added Successfully', 'data' => '']);            
		}catch(Exception $e){
			\DB::rollback();
            return response()->json(['status' => 0, 'msg' => $e->getMessage(), 'data' => '']);
		}
	}
	public function edit($id){
		if(request()->search == 1){
			if(request()->module_id_name !=''){
				$module_id_name=request()->module_id_name;
				$record=CompanyPrivilage::where('company_id',$id)->where('module_id',request()->module_id_name)->with('getMenu')->get();
			}else{
				$module_id_name='';
				$record=CompanyPrivilage::where('company_id',$id)->with('getMenu')->get();
			}
		}else{
			$module_id_name='';
			$record=CompanyPrivilage::where('company_id',$id)->with('getMenu')->get();
		}
		$id=$id;
		//dd($record[0]->getMenu->name);
		$company=CompanyMaster::get();
		$module=ModuleMaster::get();
		return view('companyprivilage.update',compact('company','module','record','module_id_name','id'));
	}
	public function update(Request $request){
		//dd($request->all());where('company_id',$request->company_id)->
		\DB::beginTransaction();
		try{
            if(count($request->yes_nos)>0){
        		for($i=0;$i<count($request->yes_nos);$i++){
        			$post=[
		            	// 'company_id'	=>	$request->company_id,
		            	// 'menu_id'		=>	$request->menu_id[$i],
		            	'permission'	=> 	$request->yes_nos[$i],
						'updated_by'	=>	'Admin',
		            	// 'login_type'	=>	$request->login_typ,
		            	// 'module_id'		=>	$request->module
		            ];
		            $save=CompanyPrivilage::where('menu_id',$request->menu_id[$i])->update($post);
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