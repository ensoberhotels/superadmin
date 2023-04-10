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
					<h4 class="card-title">Menu Master</h4>
				</div>
				<div class="col s2 m6 l6" style="text-align: right;">
					<!-- <a class="mb-6 btn waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow">Delete</a> -->
					<a href="{{URL::to('/menu-master/create')}}" class="mb-6 btn waves-effect waves-light gradient-45deg-green-teal gradient-shadow">ADD</a>
				</div>
			</div>
      <form action="{{ URL::to('/menu-master') }}">
        @csrf
        <div class="row">
        <div class="col s3">
          <div class="form-group">
            <label>Login Type</label>
            <select class="form-control" id="login_type" name="login_type">
              <option value="">Select Type</option>
              <option value="A" @if($login_type=='A') selected @endif>Admin</option>
              <option value="O" @if($login_type=='O') selected @endif>Operator</option>
            </select>
          </div>        
        </div>
        <div class="col s3">
          <div class="form-group">
            <label class="active">Module</label>
            <select class="form-control" id="module" name="module">
              <option value="">Select Module</option>
              @foreach($module as $module)
                <option value="{{$module->id}}" @if($modules==$module->id) selected @endif>{{$module->title}}</option>
              @endforeach     
            </select>
          </div>
        </div>
        <div class="col s3">
          <div class="form-group">
            <label class="active">Menu</label>
            <select class="form-control" id="file" name="file">
              <option value="">Select Menu</option>
              @foreach($file as $file)
                <option value="{{$file->id}}" @if($files==$file->id) selected @endif>{{$file->name}}</option>
              @endforeach     
            </select>
          </div>
        </div>
        <div class="col s3">
           <label></label>
          <button type="submit" name="search" value="1" class="btn waves-effect waves-light" style="margin-right: 10px;height: 26px;padding: 4px 4px 4px 4px;background-color: #1cd106;font-size: 12px;line-height: 1;margin-top: 27px;">Search</button>
          <button type="submit" name="reset" value="0" class="btn waves-effect waves-light" style="margin-right: 10px;height: 26px;padding: 4px 4px 4px 4px;background-color:#da346c;font-size: 12px;line-height: 1;margin-top: 27px;">Reset</button>
        </div>
      </div>
      </form>
      
          <div class="row">
            <div class="col s12">
               <div class="table-responsive">
              <table id="multi-select" class="table table-hover">
                <thead>
                  <tr>
                      <th>Sr. No.</th>
                      <th>Name</th>
                      <th>Short Name</th>
                      <th>Full Name</th>
                      <th>Module</th>
                      <th>Login Type</th>
                      <th>Parent Menu</th>
                      <th>T-Code</th>
                      <th>Display Order</th>
                      <th>Path</th>
                      <th>Status</th>
                      <th class="no-sort">Action</th>
                  </tr>
                </thead>
                <tbody>
                     @php $i=1;@endphp
				        @foreach($menu as $menus)
                        <tr>
                           <td>{{$i}}</td>
                           <td>{{$menus->name}}</td>
                           <td>{{$menus->sname}}</td>
                           <td>{{$menus->fname}}</td>
                           <td>{{@getModuleName($menus->module)}}</td>
                           @if($menus->login_type == 'A')
                            <td>Admin</td>
                          @else
                           <td>Operator</td>
                           @endif
                           <td>{{@getParentMenuName($menus->parent_menu_id)}}</td>
                           <td>{{$menus->tcode}}</td>
                           <td>{{$menus->display_order}}</td>
                           <td>{{$menus->path}}</td>
                           <td style="text-align: center;">
                            @if($menus->status == 'ACTIVE')
                              <span class="badge bg-success" style="border-radius: 8px;cursor: pointer;">{{$menus->status}}</span>
                            @else
                              <span class="badge bg-danger" style="border-radius: 8px;cursor: pointer;">{{$menus->status}}</span>
                            @endif
                            </td>
                           <td style="display: inline-flex;text-align: center;">
                              <a href="{{URL::to('/menu-master/')}}/{{$menus->id}}" class="badge bg-warning"><i class="fa fa-edit" style="font-size:20px;"></i></a>
                              <button type="button" onclick="removeData({{$menus->id}})" name="btn_remove" id="btn_remove" class="badge bg-danger"><i class="fa fa-remove" style="font-size:20px;"></i></button>
                           </td>
                        </tr>
                        @php $i++;@endphp
                    @endforeach
              </table>
              <div class="pagination">{{$menu->links()}}</div>
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
    padding-left: 3px;
    line-height: 1;
    font-size: 14px;
    font-weight: normal;
}
.bg-success {
    --bs-bg-opacity: 1;
    background-color: #66ff33 !important;
    border: 0px;
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
		function removeData(id){
      jQuery.ajax({
          type: "POST",
          url: '/menu-master',
          data: {'id':id},
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
                location.reload();
              }, 5000);
            }else{
              iziToast.error({timeout: 5000,title: 'Required', message: response.msg,position:'topRight'});
            }
          }
        });
    }
	</script>
@endsection