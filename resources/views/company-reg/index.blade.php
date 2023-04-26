@extends('template.base')

@section('title', 'Ensober Admin Dashboard ')

@section('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<style type="text/css">
    .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
    color: #333;
    display: none;
}
table.dataTable thead .sorting {
    /* background-image: url(../images/sort_both.png); */
    font-size: 12px;
} 
/*.table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
    border-top: 0;
    /* font-weight: normal; */
    /*font-size: 12px;*/
    /* display: inline-table; */
    width: 20%;
    /* padding-left: 26px; */
} */
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
                  <li class="breadcrumb-item"><a href="#">All Activity Sub Cats</a>
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
            <div class="section section-data-tables">
  <div class="card">
    <div class="card-content">
      <p class="caption mb-0">Tables are a nice way to organize a lot of data. We provide a few utility classes to help
        you style your table as easily as possible. In addition, to improve mobile experience, all tables on
        mobile-screen widths are centered automatically.</p>
    </div>
  </div>

  <!-- Multi Select -->

  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
			<div class="row">
				<div class="col s6">
					<h4 class="card-title">Company Registration</h4>
				</div>
				
			</div>
          <div class="row">
            <div class="col s12">
               <div class="table-responsive">
              <table id="multi-select" class="table table-hover">
                <thead>
                  <tr>
                     <th>Sr. No.</th>
                    <th>Company Name</th>
                    <th>Company Logo</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>GSTIn</th>
                    <th>Company Type</th>
                    <th>Website</th>
                    <th class="no-sort">Action</th>
                  </tr>
                </thead>
                <tbody>
                     @php $i=1;@endphp
				        @foreach($company as $companys)
                  <tr id="">
                    <td style="display: inline-block;">{{$i}}</td>
                    <td >{{$companys->company_name}}</td>
                    <td><img src="{{ asset('public/asset/company_logo/') }}/{{$companys->logo}}" height="50" width="50" alt="tag"></td>
                    <td >{{$companys->address}}</td>
                    <td>{{$companys->mobile}}</td>
                    <td>{{$companys->email}}</td>
                    <td>{{$companys->gstin}}</td>
                    <td>{{$companys->company_type}}</td>
                    <td>{{$companys->website}}</td>
                    <td style="display: inline-flex;text-align: center;" id="show_act_{{$companys->id}}">
                      @if($companys->show_flag == 'C')
                        <span onclick="return changeStatus({{$companys->id}})" name="action" class="td_status" >Pending</span>
                      @elseif($companys->show_flag == 'A')
                        <span name="action" class="td_status_inactive" >Completed</span>
                        
                      @else
                        <span onclick="return changeStatus({{$companys->id}})" name="action" class="td_status_1" >Incomplete</span>
                      @endif
                      <img src="/asset/images/btn_loader.gif" id="po_search_loader{{$companys->id}}" class="input_loader po_search_loader" style="display: none;position: unset;width: 18px;height: 18px;text-align: left;float: right;margin-left: 3px;margin-right: 8px;margin-top: 2px;">
                    </td>
                  </tr>
                  @php $i++;@endphp
              @endforeach
              </table>
              <div class="pagination">{{$company->links()}}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- START RIGHT SIDEBAR NAV -->
<!--  -->
<!-- END RIGHT SIDEBAR NAV -->
            <!-- <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"><a class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow"><i class="material-icons">add</i></a> -->
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
<style type="text/css">
   .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding-left: 0px;
    line-height: 1;
    font-size: 13px;
    font-weight: normal;
    width: 100px;
    position: relative;
    /* display: inline-block; */
    white-space: nowrap;
}
.td_status{
       margin-right: 10px;
    height: 18px;
    padding: 3px;
    background-color: #6a27a2;
    color: #fff;
    font-size: 10px;
    line-height: 1;
    border: 1px solid #6a27a2;
    border-radius: 7px;
    cursor: pointer;
}
.td_status_inactive{
       margin-right: 10px;
    height: 18px;
    padding: 3px;
    background-color: #51a90f;
    color: #fff;
    font-size: 10px;
    line-height: 1;
    border: 1px solid #51a90f;
    border-radius: 7px;
    cursor: pointer;
}
.td_status_1{
       margin-right: 10px;
    height: 18px;
    padding: 2px;
    background-color: #ff4081;
    color: #fff;
    font-size: 10px;
    line-height: 1;
    border: 1px solid #ff4081;
    border-radius: 7px;
    cursor: pointer;
}
.bg-danger{
    --bs-bg-opacity: 1;
    background-color: #ff1a1a !important;
    border: 0px;
    margin-left: 5px;
}
.bg-warning{
  --bs-bg-opacity: 1;
    background-color: #ffff1a !important;
    border: 0px;
    margin-right: 5px;
}
.badge {
    --bs-badge-padding-x: 0.45em;
    --bs-badge-padding-y: 0.35em;
    --bs-badge-font-size: 0.75em;
    --bs-badge-font-weight: 700;
    --bs-badge-color: #fff;
    --bs-badge-border-radius: 0.375rem;
    display: inline-block;
    padding: var(--bs-badge-padding-y) var(--bs-badge-padding-x);
    font-size: var(--bs-badge-font-size);
    font-weight: var(--bs-badge-font-weight);
    line-height: 1;
    color: var(--bs-badge-color);
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    /*border-radius: var(--bs-badge-border-radius);*/
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- BEGIN VENDOR JS-->
    <!-- <script src="{{ URL::asset('asset/js/vendors.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS
    <!-- BEGIN PAGE VENDOR JS
    <script src="{{ URL::asset('asset/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('asset/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('asset/js/dataTables.select.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS--
    <script src="{{ URL::asset('asset/js/plugins.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('asset/js/custom/custom-script.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('asset/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS
    <script src="{{ URL::asset(' asset/js/scripts/data-tables.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
	
	<script>
		function changeStatus(id){
         jQuery('#po_search_loader'+id).show();
         jQuery.ajax({
            type: "POST",
            url: '/company-reg/register',
            data: {'id':id},
            dataType: "json",
            success: function(response) {
               console.log(response);
               if (response.status == 1) {
                  jQuery('#po_search_loader'+id).hide();
                  if (response.status == 1) {
                    iziToast.success({
                      timeout: 5000, 
                      icon: 'fa fa-chrome', 
                      title: 'Success', 
                      message: response.msg,
                      position:'topRight'
                    });
                    setTimeout(function() {
                      var tableHTML='';
                      if(response.data == 'C'){
                         tableHTML+='<span onclick="return changeStatus('+id+')" name="action" class="td_status" >Pending</span>';
                      }else{
                         tableHTML+='<span  name="action" class="td_status_inactive" >Completed</span>';
                      }
                      jQuery('#show_act_'+id).html(tableHTML);
                    }, 5000);
                  }
               }
            }
         })
      }
	</script>
@endsection