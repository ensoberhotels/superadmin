@extends('template.base')

@section('title', 'Ensober Admin Dashboard ')

@section('styles')
    <!-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/pages/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/vendors/materialize-stepper/materialize-stepper.min.css') }}"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <style>
    body{
      overflow-x: hidden;
    }
        .step-actions {
            float: right;
        }
		.show_select select{display:block;}
    input:not([type]), input[type=text]:not(.browser-default), input[type=password]:not(.browser-default), input[type=email]:not(.browser-default), input[type=url]:not(.browser-default), input[type=time]:not(.browser-default), input[type=date]:not(.browser-default), input[type=datetime]:not(.browser-default), input[type=datetime-local]:not(.browser-default), input[type=tel]:not(.browser-default), input[type=number]:not(.browser-default), input[type=search]:not(.browser-default), textarea.materialize-textarea {
    font-size: 1rem;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
    width: 100%;
    height: 2rem;
    margin: 0 0 0px 0;
    padding: 0;
        font-size: 14px;
    -webkit-transition: border .3s, -webkit-box-shadow .3s;
    -moz-transition: box-shadow .3s, border .3s;
    -o-transition: box-shadow .3s, border .3s;
    transition: border .3s, -webkit-box-shadow .3s;
    transition: box-shadow .3s, border .3s;
    transition: box-shadow .3s, border .3s, -webkit-box-shadow .3s;
    border: none;
    border-bottom: 1px solid #9e9e9e;
    border-radius: 0;
    outline: none;
    background-color: transparent;
    -webkit-box-shadow: none;
    box-shadow: none;
}
input[type=file] {
    display: block;
    width: 100%;
    height: 34px;
    padding: 4px 4px;
    font-size: 11px;
    line-height: 1.2;
    color: #555;
    /* background-color: #fff; */
     background-image: none; 
     border-radius: 0px;
     border: 0px solid #fff; 
    -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
}
input:focus, textarea:focus, select:focus{
        outline: none;
    }
   /* .col-md-3{
      width: 25%;
    }*/
    /*.col-sm-12{
      width: 100%;
    }*/
    label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: normal;
    font-size: 13px;
}
.multiselect-wrapper ul{
  max-height: 95px !important;
}
.table_head {
  position: relative;
  overflow-x: hidden;
  /*margin-top: 40px;*/
}
.header {
  /*position: absolute;*/
    overflow-y: scroll;
    width: 100%;
    /*display: inline-table;*/
    /* height: 56px; */
    margin-top: -36px;
    /* padding-top: 20px;  /* heights, so these two lines make it work  */
}
.header .wrapper {
 position: sticky; top: 0; z-index: 1;background:#fff;
}

.content {
  padding-top: 20px;
  height: 200px;
  /*background-color: grey;*/
  overflow: auto;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 3px;
    line-height: 1;
    text-align: center;
    vertical-align: top;
    border-top: 1px solid #ddd;
}

    </style>
@endsection

@section('content')
	<!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0">Dashboard</h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="#">Activity</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Add Activity Cat</a>
                  </li>
                  
                </ol>
              </div>
              <div class="col s2 m6 l6"><a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" href="#!" data-target="dropdown1"><i class="material-icons hide-on-med-and-up">settings</i><span class="hide-on-small-onl">Settings</span><i class="material-icons right">arrow_drop_down</i></a>
                <ul class="dropdown-content" id="dropdown1" tabindex="0">
                  <li tabindex="0"><a class="grey-text text-darken-2" href="user-profile-page.html">Profile<span class="new badge red">2</span></a></li>
                  <li tabindex="0"><a class="grey-text text-darken-2" href="app-contacts.html">Contacts</a></li>
                  <li tabindex="0"><a class="grey-text text-darken-2" href="page-faq.html">FAQ</a></li>
                  <li class="divider" tabindex="-1"></li>
                  <li tabindex="0"><a class="grey-text text-darken-2" href="user-login.html">Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <div class="section section-form-wizard" style="padding-top: 0px;padding-bottom: 0px;">
              <!-- Linear Stepper -->	  
              <div class="row">
                <div class="col s12" style="margin-left: 0px;padding:0px;">
                  <div class="card" style="margin-left: 2px;margin-right: 2px;margin-top: 2px">
                    <div class="card-content" style="padding: 5px;">
                      <div class="card-header">
                          <h4 class="card-title">Create Company Privilege</h4>
                      </div>
			                <form class="add_car_form" id="add_company_form" method="POST" action="#" enctype="multipart/form-data" role="form">
			                  {{csrf_field()}}
                        <div class="row">       		
                  				<div class="col-sm-12 col-md-3">
                  				  <div class="form-group">
                  					  <label class="active">Company Name</label>
                  					  <select class="form-control" id="company_id" name="company_id">
                                <option value="">Company</option>
                                @foreach($company as $companys)
                                  <option value="{{$companys->id}}">{{$companys->company_name}}</option>
                                @endforeach     
                              </select>
                  				  </div>
                          </div>
                          <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                              <label class="active">Login Type</label>
                              <select class="form-control" id="login_typ" onchange="getModule()" name="login_typ">
                                <option value="">Select Login Type</option>
                                <option value="A">Admin</option>
                                <option value="O">Operator</option>
                              </select>
                            </div>
                  				</div>
                          <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                              <label class="active">Module</label>
                              <div id="module_body">
                                  <select class="form-control" id="module" name="module[]" multiple >
                                </select>
                              </div>
                              
                            </div>
                          </div>
                          <div class=" col-sm-12 col-md-3">
                            <label class="active" style="height: 19px;"></label>
                            <div>
                              <img src="{{URL::asset('public/asset/images/btn_loader.gif')}}" id="po_search_loader" class="input_loader po_search_loader" style="display: none; position: unset;width: 25px;height: 25px;text-align: left;float: left;margin-left: -27px;margin-right: 10px;margin-top: 3px;">
                              <button class="btn waves-effect waves-light left" type="button" onclick="return getTableData()" name="action" id="add_hotel" style="margin-right: 10px;height: 26px;padding: 4px 3px;background-color: #127623;font-size: 12px;line-height: 1;">Loading
                                <!-- <i class="material-icons right">send</i> -->
                              </button>
                            </div>
                          </div>
                       </div>
                       <div class="row">
                          <div class="col s12">
                            <div class="table-responsive table_head" style="height: 350px;overflow-y: scroll;">
                              <table id="multi-select" class="table table-hover">
                                <thead class="header">
                                  <tr class="wrapper">
                                      <th>Sr. No.</th>
                                      <th style="text-align: left;">Menu Name</th>
                                      <th>Show / Hide <input type="checkbox" class="custome_checkbox" name="checked" id="checked" onclick="checkAll()" value="N"></th>
                                  </tr>
                                </thead>
                                <tbody id="table_body" class="content">
                                  
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class=" col-sm-12 col-md-3">
                            <label class="active" style="height: 19px;"></label>
                            <div>
                              <img src="{{URL::asset('public/asset/images/btn_loader.gif')}}" id="po_search_loader1" class="input_loader po_search_loader" style="display: none; position: unset;width: 25px;height: 25px;text-align: left;float: left;margin-left: -27px;margin-right: 10px;margin-top: 3px;">
                              <button class="btn waves-effect waves-light left" type="button" onclick="saveData()" name="action" id="add_hotel" style="margin-right: 10px;height: 26px;padding: 4px 3px;background-color: #127623;font-size: 12px;line-height: 1;">Save
                                <!-- <i class="material-icons right">send</i> -->
                              </button>
                              <a href="{{URL::to('/company-privilege')}}" class="btn waves-effect waves-dark" style="background-color: #bfb32b;color: #fff;height: 26px;padding: 6px 4px;font-size: 12px;line-height: 1;">Back</a>
                            </div>
                          </div>
                        </div>
            </form>
                </div>
            </div>
        </div>
    </div>




</div>
<!-- END RIGHT SIDEBAR NAV -->
           
    <!--<ul>
        <li><a href="css-helpers.html" class="btn-floating blue"><i class="material-icons">help_outline</i></a></li>
        <li><a href="cards-extended.html" class="btn-floating green"><i class="material-icons">widgets</i></a></li>
        <li><a href="app-calendar.html" class="btn-floating amber"><i class="material-icons">today</i></a></li>
        <li><a href="app-email.html" class="btn-floating red"><i class="material-icons">mail_outline</i></a></li>
    </ul>-->
</div>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
@endsection

@section('scripts')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('public/asset/css/multiselect.css') }}">
<script src="{{ URL::asset('public/asset/js/multiselect.min.js') }}" type="text/javascript"></script>
<style type="text/css">
  .select-dropdown,.dropdown-trigger{
    display: none;
  }
  .select-wrapper .caret {
    position: absolute;
    z-index: 0;
    top: 0;
    right: 0;
    bottom: 0;
    margin: auto 0;
    fill: rgba(0, 0, 0, .87);
    display: none;
}
.caret {
    display: none;
    width: 0;
    height: 0;
    margin-left: 2px;
    vertical-align: middle;
    border-top: 4px dashed;
    border-top: 4px solid\9;
    border-right: 4px solid transparent;
    border-left: 4px solid transparent;
}
.select-wrapper .select-dropdown {
    display: none !important;
}
th {
    margin: 0 !important;
    padding: 6px 5px 6px !important;
    background: #eee;
}
/*[type='checkbox']:not(:checked), [type='checkbox']:checked {
    position: absolute;
    pointer-events: none;
    opacity: 1;
    margin-left: 10px;
}*/

</style>
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- <script src="{{ URL::asset('asset/vendors/materialize-stepper/materialize-stepper.min.js') }}"></script> -->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <!-- <script src="{{ URL::asset('asset/js/plugins.js') }}" type="text/javascript"></script> -->
    <!--<script src="{{ URL::asset('asset/js/custom/custom-script.js') }}" type="text/javascript"></script>-->
    <!-- <script src="{{ URL::asset('asset/js/scripts/customizer.js') }}" type="text/javascript"></script> -->
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- <script src="{{ URL::asset('asset/js/scripts/form-wizard.js') }}" type="text/javascript"></script> -->
    <!-- END PAGE LEVEL JS-->
     
	   <script type="text/javascript">
       function saveData(){
        var company_id = jQuery('#company_id').val();
        var login_typ  = jQuery('#login_typ').val();
        var modulee    = jQuery('#module').val();
        if (company_id=='') {
          jQuery('#company_id').css('border','1px solid red');
          return false;
        }
        else{
          jQuery('#company_id').css('border', '1px solid green');
        }
        if (login_typ=='') {
          jQuery('#login_typ').css('border','1px solid red');
          return false;
        }
        else{
          jQuery('#login_typ').css('border', '1px solid green');
        }
        if (modulee=='') {
          jQuery('#module').css('border','1px solid red');
          return false;
        }
        else{
          jQuery('#module').css('border', '1px solid green');
        }
         var form=new FormData(document.getElementById('add_company_form'));
         jQuery('#po_search_loader1').show();
         console.log(form);
         jQuery.ajax({
          type: "POST",
          url: '/company-privilege/save',
          data: form,
          processData: false,
          contentType: false,
          dataType: "json",
          success: function(response) {
            console.log(response);
            if (response.status == 1) {
              jQuery('#po_search_loader1').hide();
              iziToast.success({
                timeout: 5000, 
                icon: 'fa fa-chrome', 
                title: 'Success', 
                message: response.msg,
                position:'topRight'
              });
              setTimeout(function() {
                location.href='/company-privilege';
              }, 5000);
            }else{
              jQuery('#po_search_loader1').hide();
              iziToast.error({timeout: 5000,title: 'Required', message: response.msg,position:'topRight'});
            }
          }
        });
      } 
      function getTableData(){
        var company_id = jQuery('#company_id').val();
        var login_typ  = jQuery('#login_typ').val();
        var modulee    = jQuery('#module').val();
        if (company_id=='') {
          jQuery('#company_id').css('border','1px solid red');
          return false;
        }
        else{
          jQuery('#company_id').css('border', '1px solid green');
        }
        if (login_typ=='') {
          jQuery('#login_typ').css('border','1px solid red');
          return false;
        }
        else{
          jQuery('#login_typ').css('border', '1px solid green');
        }
        if (modulee=='') {
          jQuery('#module').css('border','1px solid red');
          return false;
        }
        else{
          jQuery('#module').css('border', '1px solid green');
        }
        jQuery('#po_search_loader').show();
        var modules=jQuery('#module').val();
        jQuery.ajax({
          type: "POST",
          url: '/company-privilege/data',
          data: {'module':modules,'company_id':company_id,'login_typ':login_typ},
          dataType: "json",
          success: function(response) {
            console.log(response);
            if (response.status == 1) {
              jQuery('#po_search_loader').hide(3000);
              jQuery('#table_body').html(response.data);
            }else{
              jQuery('#table_body').html("<tr> <td colspan='3'>Data not found</td></tr>");
            }
          }
        });
      }
      function check(id){
        var check_val=jQuery('#yes_no_'+id).val();
        // alert(check_val);
        if(check_val == 'N'){
          jQuery('#yes_no_'+id).val('Y');
          jQuery('#yes_nos_'+id).val('Y');
        }else{
          jQuery('#yes_no_'+id).val('N');
          jQuery('#yes_nos_'+id).val('N');
        }
      }
      function checkAll(){
        var status = $("#checked").is(":checked") ? true : false;
        $(".chk").prop("checked",status);
        if(status){
            $(".chk").val('Y');
            $(".chks").val('Y');
        }else{
            $(".chk").val('N');
            $(".chks").val('N');
        }
      }
      
      function getModule(){
        if(jQuery('#company_id').val()== ''){
          iziToast.error({timeout: 4000,title: 'Required', message: 'Please select company first!',position:'topRight'});
        }else{
          var login_typ=jQuery('#login_typ').val();
          jQuery.ajax({
            type: "POST",
            url: '/company-privilege/logintyp',
            data: {'login_typ':login_typ},
            dataType: "json",
            success: function(response) {
              console.log(response);
              if (response.status == 1) {
                jQuery('#module_body').html(response.data);
                jQuery('#module').multiselect({
                  columns: 1,
                  // placeholder: 'Select Module',
                  search: true,
                  selectAll: true
                });
              }else{
                jQuery('#table_body').html("<tr> <td colspan='3'>Data not found</td></tr>");
              }
            }
          });
        }
      }
      jQuery('#module').multiselect({
        columns: 1,
        // placeholder: 'Select Module',
        search: true,
        selectAll: true
      }); 
      jQuery('.multiselect-checkbox').click(function(){
        jQuery('#module_inputCount').css('display','none');
        jQuery('#module_inputCount').css('visibility', 'hidden');
      });
     </script>
<style type="text/css">
  .iziToast.iziToast-color-red {
    background: #ff0000;
    border-color: #ff0000;
}
.multiselect-wrapper .multiselect-list {
    padding: 5px;
    padding-top: 5px;
    padding-right: 5px;
    padding-bottom: 5px;
    padding-left: 5px;
    min-width: 180px;
}
.multiselect-dropdown-arrow {
    /* width: 0; */
    /* height: 0; */
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid black;
    position: absolute;
    line-height: 20px;
    text-align: center;
    display: inline-block !important;
    margin-top: 40px;
    margin-left: -42px;
}
[type='checkbox'] + span:not(.lever) {
    font-size: 13px;
    line-height: 18px;
    position: relative;
    display: inline-block;
    height: 15px;
    padding-left: 35px;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.multiselect-wrapper label {
    display: block;
    font-size: 23px;
    font-weight: 600;
}
label {
    /*font-size: .8rem;*/
    color: black;
}
input:not([type]), input[type=text]:not(.browser-default), input[type=password]:not(.browser-default), input[type=email]:not(.browser-default), input[type=url]:not(.browser-default), input[type=time]:not(.browser-default), input[type=date]:not(.browser-default), input[type=datetime]:not(.browser-default), input[type=datetime-local]:not(.browser-default), input[type=tel]:not(.browser-default), input[type=number]:not(.browser-default), input[type=search]:not(.browser-default), textarea.materialize-textarea {
    font-size: 1rem;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
    width: 100%;
    height: 30px;
    margin-top: 0px;
    padding: 0;
    font-size: 17px;
    font-size: 15px;
    -webkit-transition: border .3s, -webkit-box-shadow .3s;
    -moz-transition: box-shadow .3s, border .3s;
    -o-transition: box-shadow .3s, border .3s;
    transition: border .3s, -webkit-box-shadow .3s;
    transition: box-shadow .3s, border .3s;
    transition: auto;
    border: none;
    border: 1px solid #9e9e9e;
    border-radius: 7px;
    outline: none;
    background-color: transparent;
    -webkit-box-shadow: none;
    box-shadow: black;
}
.multiselect-wrapper .multiselect-list > span, .multiselect-wrapper .multiselect-list li {
    cursor: default;
    float: left;
}
.multiselect-wrapper label {
    display: block;
    font-size: 22px;
    font-weight: 600;
    /* margin-top: 6px; */
    text-align: center;
}
.multiselect-dropdown-arrow {
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid black;
    position: absolute;
    line-height: 18px;
    text-align: center;
    display: inline-block !important;
    margin-top: 18px;
    margin-left: -35px;
}
.multiselect-wrapper ul li:hover {
    background-color: white;
    /* color: white; */
}
.multiselect-wrapper ul li.active {
    background-color: white;
    color: black;
}
.multiselect-wrapper .multiselect-list.active {
    display: inline-block;
    width: 60px;
}
.multiselect-count {
    position: relative;
    text-align: center;
    border-radius: 2px;
    /* background-color: lightblue; */
    display: none;
    padding: 0px 3px;
    left: -45px;
}
.btn.focus, .btn:focus, .btn:hover {
    color: #fff;
    text-decoration: none;
}
.multiselect-wrapper .multiselect-list {
    z-index: 3;
    position: absolute;
    display: none;
    background-color: white;
    border: 1px solid grey;
    border-bottom-left-radius: 2px;
    border-bottom-right-radius: 2px;
    /* margin-top: -2px; */
}
</style>
@endsection