@extends('template.base')

@section('title', 'Ensober Admin Dashboard ')

@section('styles')
    <!-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/css/pages/form-wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('asset/vendors/materialize-stepper/materialize-stepper.min.css') }}"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <style>
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
.select-wrapper .select-dropdown {
    display: none !important;
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
            <div class="section section-form-wizard">
              <!-- Linear Stepper -->	  
              <div class="row">
                <div class="col s12">
                  <div class="card">
                    <div class="card-content">
                      <div class="card-header">
                          <h4 class="card-title">Update New Company</h4>
                      </div>
			                <form class="add_car_form" id="add_company_form" method="POST" action="#" enctype="multipart/form-data" role="form">
			                  {{csrf_field()}}
                        <div class="row">       		
                  				<div class="col-sm-12 col-md-3">
                  				  <div class="form-group">
                  					 <label class="active">Company Name</label>
                  					 <input type="text" name="company_name" value="{{$record->company_name}}" id="company_name" class="form-control">	
                  				  </div>
                  				</div>
                          <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                             <label class="active">Company Logo</label>
                             <input type="file" name="company_logo" value="{{$record->logo}}" id="company_logo" class="form-control">
                             <img src="{{ asset('asset/company_logo/') }}/{{$record->logo}}" height="50" width="50" alt="tag"> 
                            </div>
                          </div>
				                  <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                             <label class="active">Company Website</label>
                             <input type="text" name="company_web" id="company_web" value="{{$record->website}}" class="form-control"> 
                            </div>
                          </div>
				                  <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                             <label class="active">Company Mobile</label>
                             <input type="number" name="company_mobile" id="company_mobile" value="{{$record->mobile}}" class="form-control"> 
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                             <label class="active">Company Email</label>
                             <input type="email" value="{{$record->email}}" name="company_email" id="company_email" class="form-control"> 
                            </div>
                          </div>
                          <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                             <label class="active">Company GSTIn</label>
                             <input type="text" value="{{$record->gstin}}" name="company_gstin" id="company_gstin" class="form-control"> 
                            </div>
                          </div>
                          <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                             <label class="active">Company Address</label>
                             <input type="text" value="{{$record->address}}" name="company_add" id="company_add" class="form-control"> 
                            </div>
                          </div>
                          <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                             <label class="active">Company Type</label>
                             <select name="company_type" id="company_type" class="form-control"> 
                                <option value="">Company Type</option>
                                <option value="HOTEL" @if($record->company_type =='HOTEL') selected @endif>HOTEL</option>
                                <option value="TRANSPORT" @if($record->company_type =='TRANSPORT') selected @endif>TRANSPORT</option>
                                <option value="EVENT" @if($record->company_type =='EVENT') selected @endif>EVENT</option>
                             </select>
                            </div>

                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                             <label>No Of Property</label>
                             <select name="no_of_user" id="no_of_user" class="form-control"> 
                                @for($i=1;$i<=8;$i++)
                                  <option value="{{$i}}" @if($record->no_of_user ==$i) selected @endif>{{$i}}</option>
                                @endfor
                             </select> 
                            </div>
                          </div>
                          <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                             <label class="active">Company Description</label>
                             <textarea type="text" name="company_desc" id="company_desc" class="form-control">{{@$record->description}}</textarea>
                             <input type="hidden" name="id" value="{{@$record->id}}" id="id" class="form-control"> 
                            </div>
                          </div>
                          <div class=" col-sm-12 col-md-3" style="width: 25%;">
                            <label style="height: 25px;"></label>
                            <div>
                              <button class="btn waves-effect waves-light left" type="button" onclick="updateData()" name="action" id="add_hotel" style="margin-right: 10px;height: 26px;padding: 4px 3px;background-color: #127623;font-size: 12px;line-height: 1;">Update</button>
                            <a href="{{URL::to('/company-master')}}" class="btn waves-effect waves-dark " style="background-color: #bfb32b;color: #fff;height: 26px;padding: 6px 4px;font-size: 12px;line-height: 1;">Back</a>
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
    <style type="text/css">
  input.select-dropdown{
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
.iziToast.iziToast-color-green {
    background: #18b318;
    border-color: #18b318;
    color: white;
}
.iziToast.iziToast-animateInside .iziToast-message, .iziToast.iziToast-animateInside .iziToast-title {
    opacity: 0;
    color: white;
}
.iziToast>.iziToast-body .iziToast-title {
    color: #fff;
    margin: 0;
}
</style>
    <!-- END PAGE LEVEL JS-->
	   <script type="text/javascript">
       function updateData(){
         var form=new FormData(document.getElementById('add_company_form'));
         console.log(form);
         jQuery.ajax({
          type: "POST",
          url: '/company-master/update',
          data: form,
          processData: false,
          contentType: false,
          dataType: "json",
          success: function(response) {
            console.log(response);
            if (response.status == 1) {
              iziToast.success({
                timeout: 5000, 
                icon: 'fa fa-chrome', 
                title: 'Success', 
                message: response.msg,
                position:'topRight'
              });
              setTimeout(function() {
                location.href='/company-master';
              }, 5000);
            }else{
              iziToast.error({timeout: 5000,title: 'Required', message: response.msg,position:'topRight'});
            }
          }
        });
      } 
     </script>
@endsection