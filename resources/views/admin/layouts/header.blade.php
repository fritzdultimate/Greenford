<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{ $page_title }}</title>
    <meta content="width=device-width, initial-scale=0.8, maximum-scale=0.8" name="viewport" />
    <meta name="description" content="SiteName" />
    <meta name="keywords" content="SiteName" />
    <meta name="author" content="" />
    <meta name="MobileOptimized" content="320" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dash/css/animate.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dash/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dash/css/fonts.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dash/plugins/lobibox/css/lobibox.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dash/css/flaticon2.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dash/css/font-awesome.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dash/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dash/css/owl.theme.default.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('dash/css/nice-select.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dash/css/datatables.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('dash/css/dropify.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dash/css/reset.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dash/css/magnific-popup.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ $mode == 'ddark' ? asset('dash/css/style.css?b=8') : asset('dash/css/light-theme.css') }}" id="app-theme"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('dash/css/responsive.css?a=7') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('dash/css/custom.css?a=4') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}" />
</head>
<body class="{{ $mode }}">
    @include('preloader.index')
    <a href="javascript:" id="return-to-top"> <i class="fas fa-angle-double-up"></i></a>
	 <div class="cp_navi_main_wrapper inner_header_wrapper dashboard_header_middle float_left">
        <div class="container-fluid">
              <div class="cp_logo_wrapper">
                <a href="/admin">
                    <img class="logo-dark" src="{{ asset('assets/images/email_logo.png') }}" srcset="{{ asset('assets/images/email_logo.png') }} 2x" alt="logo" style="width:250px">
                </a>
            </div>
            <header class="mobail_menu d-block d-sm-block d-md-block ">
                <div class="container-fluid">
                    <div class="row">				
                       <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end">
                           <div class="crm_profile_dropbox_wrapper mr-1 d-none">
                            <div class="nice-select" tabindex="0">
                                <span class="current"><img src="/images/avatar.png" alt="img"> 
                                    <span class="d-none d-md-inline-flex"> hi, {{ $user['name'] }} </span><span class="hidden_xs_content"></span></span>
                                <ul class="list">
    
                                    <li><a href="#"><i class="flaticon-profile"></i> Profile</a>
                                    </li>
                                    <li><a href="#"><i class="flaticon-purse"></i> My Balance</a>
                                    </li>
                                   
                                    <li><a href="#"><i class="flaticon-settings"></i> Setting</a>
                                    </li>
                                    
                                    <li><a href="#"><i class="flaticon-turn-off"></i> Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div data-toggle-fullscreen class="d-inline-flex justify-content-center align-items-center px-3 mx-2 fullscreen-btn" style="color: grey">
                            <i class="nav-icon fas fa-expand" data-opp="fas fa-compress" style="font-size:larger"></i>
                        </div>
                        <div class="cd-dropdown-wrapper d-flex align-items-center d-lg-none d-xl-none p-0 " style="color: grey">
                            <a class="house_toggle inner_toggle" href="#0">
                                <i class="fa fa-bars" style="font-size:larger"></i>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </header>
        </div>
    </div>