<?php 
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse; 
use App\CompanyPrivilage;
use App\Admin;
use App\Vender;
use App\Hotel;
use App\Operator;
use App\HotelGallery;
use App\HotelAmenity;
use App\Amenity;
use App\RoomCategory;
use App\HotelSeasonRate;
use App\PaidAmenity;
use App\HotelGroupSeasonRate;
use App\ActivityCat;
use App\ActivityName;
use App\ActivitySubCat;
use App\Country;
use App\Region;
use App\City;
use App\Lead;
use App\Quotation;
use App\SendQuotation;
use App\Sale;
use App\RoomTypes;
use App\Car;
use App\CarSegment;
use App\CarModel;
use App\CarSeats;
use App\AssignContacts;
use App\Contacts;
use App\BulkEmailSendReport;
use App\BulkEmailSend;
use App\EmailTemplat;
use App\EmailCampaign;
use App\EmailList;
use App\Transport;
use App\Via;
use App\Activity;
use App\PaymentSource;
use App\PaymentHistory;
use App\DayWiseDetail;
use App\ITIRoute;
use App\ITIBasicInfo;
use App\ITITransport;
use App\ITIHotel;
use App\ITIActivity;
use App\ITIPrice;
use App\ITIDayWiseItinerary;
use App\ITIActivitiPriceList;
use App\ITIHotelPriceList;
use App\ITITranportPriceList;
use App\MenuMaster;
use App\ModuleMaster;
use App\CompanyMaster;
use Illuminate\Support\Facades\Session;

if (!function_exists('getHotelRoomName')) {
    function getHotelRoomName($hotel_id, $room_type) {
        $RoomName = RoomCategory::select('name')
        ->where('hotel_id',$hotel_id)
        ->where('room_type_id',$room_type)
        ->first();
        return $RoomName->name;
    }
}

// This function use for get the payment source by id
if (!function_exists('getPaymentSource')) {
    function getPaymentSource($id) {
        $PaymentSource = PaymentSource::select('source')
        ->where('id',$id)
        ->first();
		if($PaymentSource){
			return $PaymentSource->source;
		}
    }
}

// This function use for get the hotel name by id
if (!function_exists('getHotelName')) {
    function getHotelName($id) {
        $Hotel = Hotel::select('hotel_name')
        ->where('id',$id)
        ->first();
        return $Hotel->hotel_name;
    }
}

// This function use for get the city name by id
if (!function_exists('getCityName')) {
    function getCityName($id) {
        $City = City::select('name')
        ->where('id',$id)
        ->first();
        return $City->name;
    }
}

// This function use for get the owner received amount by quotation_no
if (!function_exists('getOwnerReceivedAmount')) {
    function getOwnerReceivedAmount($send_quotation_no) {
        $Quotation = SendQuotation::where('send_quotation_no', $send_quotation_no)->first();
		$hotel_id = $Quotation->hotel_id;
        
		$PaymentSources = PaymentSource::select('id')->where('hotel_id', $hotel_id)->where('owner', '1')->get()->pluck('id')->toArray();
		
		$amount = PaymentHistory::where('send_quotation_no', $send_quotation_no)->whereIn('payment_to_id', $PaymentSources)->sum('amount');
        return $amount;
    }
}

// This function use for get the hotel received amount by quotation_no
if (!function_exists('getHotelReceivedAmount')) {
    function getHotelReceivedAmount($send_quotation_no) {
        $Quotation = SendQuotation::where('send_quotation_no', $send_quotation_no)->first();
		$hotel_id = $Quotation->hotel_id;
        
		$PaymentSources = PaymentSource::select('id')->where('hotel_id', $hotel_id)->where('owner', '0')->get()->pluck('id')->toArray();
		
		$amount = PaymentHistory::where('send_quotation_no', $send_quotation_no)->whereIn('payment_to_id', $PaymentSources)->sum('amount');
        return $amount;
    }
}


// This function use for get the module name by menus->module
if (!function_exists('getModuleName')) {
    function getModuleName($id) {
        $module = ModuleMaster::where('id', $id)->first();
		$module_name = $module->title;
        return $module_name;
    }
}

// This function use for get the parant menu name by menus->parent_menu_id
if (!function_exists('getParentMenuName')) {
    function getParentMenuName($id) {
        $menu = MenuMaster::where('id', $id)->first();
		$menu_name = $menu->name;
        return $menu_name;
    }
}
if(!function_exists('getLoginType')){
    function getLoginType($com,$typ){
        $data=CompanyPrivilage::where('company_id',$com)->where('login_type',$typ)->where('permission','Y')->count();
        //dd($data);
        return $data;
    }
}
if(!function_exists('getCompanyName')){
    function getCompanyName($com){
        $data=CompanyMaster::where('id',$com)->first();
        if($data){
			return $data->company_name;
		}
    }

}
// This function use for get the parant menu name by menus->parent_menu_id
if (!function_exists('getCompanyPassword')) {
    function getCompanyPassword($id) {
        $Admin = Admin::where('comp_admin_id', $id)->first();
		$password = $Admin->password;
        return $password;
    }
}
?>