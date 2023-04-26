   <!-- BEGIN: SideNav-->
   <style>
    .activenav{
      background-color: #7b1fa2 !important;
    }
   </style>
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
      <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="index.html"><img src="{{ URL::asset('asset/images/logo/logo.png') }}" alt="logo"/><span class="logo-text hide-on-med-and-down"></span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
      </div>
      <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="active"><a class="collapsible-body active" href="{{URL::to('/dashboard')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Dashboard</span></a></li>
		    <li class="navigation-header"><a class="navigation-header-text">Applications</a><i class="navigation-header-icon material-icons">more_horiz</i></li>
	 			
				<li class="bold @if(Request::segment(1) == 'company-master') {{ 'active activenav' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="{{URL::to('/company-master')}}"><i class="material-icons">apartment</i><span class="menu-title" data-i18n="">Company Master</span></a></li>
        <li class="bold @if(Request::segment(1) == 'module-master') {{ 'active activenav' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="{{URL::to('/module-master')}}"><i class="material-icons">view_module</i><span class="menu-title" data-i18n="">Module Master</span></a></li>
        <li class="bold @if(Request::segment(1) == 'menu-master') {{ 'active activenav' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="{{URL::to('/menu-master')}}"><i class="material-icons">menu</i><span class="menu-title" data-i18n="">Menu Master</span></a></li>
        <li class="bold @if(Request::segment(1) == 'company-privilege') {{ 'active activenav' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="{{URL::to('/company-privilege')}}"><i class="material-icons">fact_check</i><span class="menu-title" data-i18n="">Company Privilege</span></a></li>
        <li class="bold @if(Request::segment(1) == 'company-reg') {{ 'active activenav' }} @endif"><a class="collapsible-header waves-effect waves-cyan " href="{{URL::to('/company-reg')}}"><i class="material-icons">fact_check</i><span class="menu-title" data-i18n="">Company Registration</span></a></li>
                    <!-- <div class="collapsible-body">
                        <ul class="collapsible" data-collapsible="accordion">
                            <li><a class="collapsible-body" href="{{URL::to('/admin/hotel')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Hotel Vendor</span></a>
                            </li>
                            <li><a class="collapsible-body" href="{{URL::to('/admin/hotel')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Activity Vendor</span></a> 
                            </li>
							
							<li><a class="collapsible-body" href="{{URL::to('/admin/hotel')}}" data-i18n=""><i class="material-icons">radio_button_unchecked</i><span>Transport Vendor</span></a> 
                            </li>
                        </ul>
                    </div> -->
      </ul>
    </aside>
    <!-- END: SideNav-->