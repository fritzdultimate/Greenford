<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>{{ env('SITE_NAME') }}</title>
    <meta name="description" content="{{ env('SITE_NAME') }} Online Banking System">
    <meta name="keywords"
        content="bank, wallet, banking, fintech mobile app, money, send, receive, withdraw" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('app_assets/img/icon/192x192.png') }}">
    <link rel="stylesheet" href="{{ asset('app_assets/css/style.css') }}">
    <!-- <link rel="manifest" href="__manifest.json"> -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body class="{{ $user_settings->dark_mode ? 'dark-mode' : '' }}">

    <!-- loader -->
    <!-- <div id="loader">
        <img src="assets/img/loading-icon.png" alt="icon" class="loading-icon">
    </div> -->
    <!-- * loader -->

    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            <img src="{{ asset('assets/img/favicon.png') }}" alt="{{ env('SITE_NAME') }}" class="logo"> GFCU
        </div>
        <div class="right">
            <a href="/user/notifications" class="headerButton">
                <ion-icon class="icon" name="notifications-outline"></ion-icon>
                <span class="badge badge-danger">{{ $notification_count }}</span>
            </a>
            <a href="/user/settings" class="headerButton">
                <img src="{{$user_settings->profile_image_url ? asset($user_settings->profile_image_url) : asset('app_assets/img/sample/avatar/avatar1.png') }}" alt="image" class="imaged w32">
            </a>
        </div>
    </div>
    <!-- * App Header -->