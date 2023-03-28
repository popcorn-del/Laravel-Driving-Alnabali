@yield('css')

<!-- Bootstrap Css -->
<link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/toastr/toastr.min.css') }}">
<link href="{{ URL::asset('/assets/admin/style.css') }}" rel="stylesheet" type="text/css" />

<style type="text/css">
	#datatable_filter{
		float: left;
	    margin-left: 21%;
	    margin-top: 0.5vw;
	}
	#datatable_length{
		float: right;
    	margin-top: 0.5vw;
	}
	#side-menu .mm-active{
		display: flex;
    	justify-content: space-between;
		background-color: rgba(255, 255, 255, .5);
	}
	.has-arrow.waves-effect.mm-active {
		display: block !important;
	}
	#side-menu .mm-active .sub-menu.mm-collapse {
		background-color: rgba(0,0,0,0);
	}
	#side-menu .mm-active::after{
		content: '';
		width: 5px;
		background-color: #F38121;
	}
	.simplebar-offset{
		right: -5px !important;
	}
	.simplebar-height-auto-observer-wrapper {
		overflow: visible !important;
	}
	.simplebar-mask {
		overflow: visible !important;
	}
	#side-menu li a.waves-effect {
		padding-left: 10px !important;
	}
	.daysofweek {
		margin-left: 0;
		margin-right: 0;
	}
    label{
        text-transform: uppercase;
    }
</style>
