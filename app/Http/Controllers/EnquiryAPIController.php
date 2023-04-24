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
use PDF;
use Validator;
use Illuminate\Support\Facades\Session;
use App\ApplyCompRegMaster;
class EnquiryAPIController extends Controller
{
	
	public function save(Request $request){
		//dd(65565676);
		//dd($request->all());
		\DB::beginTransaction();
		try{
			$validator = \Validator::make($request->all(), [ 
            	'company_name'=>'required',
            	// 'company_gstin'=>'required',
            	'company_type'=>'required',
            	'company_mobile'=>'required',
            	'company_email'=>'required|email|unique:sua_company_master,email',
            	'name'=>'required',
            	'gstin'=>'required'
            ]);
            if ($validator->fails()) { 
                return response()->json(['status' => 0, 'msg' => 'Error: '.$validator->errors()->first(), 'data' => '']);
            }
           if($request->file('company_logo')){
           	$logo = time().'_'.$request->file('company_logo')->getClientOriginalName();   
           	//dd($name);   
              $destinationPath = public_path('/asset/company_logo');
              $request->file('company_logo')->move($destinationPath, $logo);
           }
            	$CompanyMaster=new ApplyCompRegMaster();
            	$CompanyMaster->company_name	=	$request->company_name;
							$CompanyMaster->gstin			=	$request->gstin;
							$CompanyMaster->company_type	=	$request->company_type;
							$CompanyMaster->mobile		=	$request->company_mobile;
							$CompanyMaster->email			=	$request->company_email;
							// $CompanyMaster->website		=	$request->company_web;
							$CompanyMaster->description	=	$request->company_desc;
							$CompanyMaster->logo			=	(isset($logo) ? $logo : '');
							$CompanyMaster->address		=	$request->company_add;
							$CompanyMaster->name	= $request->name;
							//dd($CompanyMaster);
            	$CompanyMaster->save();

            
            $message= '<table>
            	<tr>
            		<td>Dear</td>
            		
            	</tr>
            	<tr>
            			<td>Your request has been sent to the admin for next process.<br>

            			<br>
            			Thankyou<br>
            			Admin
            	</tr>
            </table>';
            $from =$request->username;
            $to =$request->username;
            $subject = 'Your Request';
            $pdf_name='';$ccemail='';
            //$sav=Admin::insert($data);
            $this->send($message, $subject, $from, $to, $pdf_name='', $ccemail='');
            if($CompanyMaster){
            	\DB::commit();
            	//dd($save);
            	return response()->json(['status' => 1, 'msg' => 'Added Successfully', 'data' =>'']);
            }else{
            	\DB::rollback();
            	return response()->json(['status' => 0, 'msg' => 'Data not save!', 'data' => '']);
            }
            
		}catch(Exception $e){
			\DB::rollback();
            return response()->json(['status' => 0, 'msg' => $e->getMessage(), 'data' => '']);
		}
	}
	
}