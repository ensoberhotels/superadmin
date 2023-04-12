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
                          <h4 class="card-title">Update New Menu</h4>
                      </div>
			                <form class="add_car_form" id="add_company_form" method="POST" action="#" enctype="multipart/form-data" role="form">
                        {{csrf_field()}}
                        
                       <div class="row">
                          <div class="col s12">
                            <div class="table-responsive">
                              <table id="multi-select" class="table table-hover">
                                <thead>
                                  <tr>
                                      <th>Sr. No.</th>
                                      <th>Menu Name</th>
                                      <th>Show / Hide <input type="checkbox" class="custome_checkbox" name="checked" id="checked" onclick="checkAll()" value="N"></th>
                                  </tr>
                                </thead>
                                <tbody id="table_body">
                                    @php $i=1;$yes_no='';$checked=''; @endphp
                                    @foreach($record as $records)
                                      <tr>
                                        <td>{{$i}}</td>
                                        <td>{{@$records->getMenu->name}}<input type="hidden" name="menu_id[]" value="{{$records->menu_id}}"></td>
                                        <td><input type="checkbox" class="custome_checkbox chk" style="height: auto !important;" name="yes_no[]" id="yes_no_{{$i}}" @if($records->permission == 'Y') checked @endif onchange="check({{$i}})" value="{{$records->permission}}">
                                        <input type="hidden" name="yes_nos[]" class="chks" id="yes_nos_{{$i}}" value="{{$records->permission}}"></td>
                                      </tr>
                                      @php $i++; @endphp
                                    @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class=" col-sm-12 col-md-3">
                            <label class="active" style="height: 19px;"></label>
                            <div>
                              <img src="/asset/images/btn_loader.gif" id="po_search_loader1" class="input_loader po_search_loader" style="display: none; position: unset;width: 25px;height: 25px;text-align: left;float: left;margin-left: -27px;margin-right: 10px;margin-top: 3px;">
                              <button class="btn waves-effect waves-light left" type="button" onclick="updateData()" name="action" id="add_hotel" style="margin-right: 10px;height: 26px;padding: 0px 0px;font-size: 12px;line-height: 1;">Update
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
.select-wrapper .select-dropdown {
    display: none !important;
}
</style>
    <!-- END PAGE LEVEL JS-->
	   <script type="text/javascript">
       function updateData(){
         var form=new FormData(document.getElementById('add_company_form'));
         console.log(form);
         jQuery.ajax({
          type: "POST",
          url: '/company-privilege/update',
          data: form,
          processData: false,
          contentType: false,
          dataType: "json",
          beforeSend:function(){
            jQuery('#po_search_loader1').show();
          },
          success: function(response) {
            jQuery('#po_search_loader1').hide();
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
                location.href='/company-privilege';
              }, 5000);
            }else{
              iziToast.error({timeout: 5000,title: 'Required', message: response.msg,position:'topRight'});
            }
          }
        });
      } 
      function getTableData(){
        var modules=jQuery('#module').val();
        jQuery.ajax({
          type: "POST",
          url: '/company-privilege/data',
          data: {'module':modules},
          dataType: "json",
          success: function(response) {
            console.log(response);
            if (response.status == 1) {
              jQuery('#table_body').html(response.data);
            }else{
              jQuery('#table_body').html("<tr> <td colspan='3'>Data not found</td></tr>");
            }
          }
        });
      }
      function check(id){
        var check_val=jQuery('#yes_no_'+id).val();
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
jQuery(document).ready(function(){
        getTableData();
      })
     </script>
@endsection