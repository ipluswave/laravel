<!DOCTYPE html>
<!--[if IE 8]> <html lang="{{ trans('common.language') }}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="{{ trans('common.language') }}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ trans('common.language') }}">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="@yield('description')" name="description"/>
        <meta content="@yield('author')" name="author"/>
        <meta property="wb:webmaster" content="4bfa78a5221bb48a" />
		<meta property="qc:admins" content="2552431241756375" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        @include('frontend.includes.headscript')
        <link rel="shortcut icon" href="favicon.ico" />
        @section('header') @show
        <!-- END HEAD -->
    </head>

    <body lang="{{ trans('common.language') }}" class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md" style="{{ $bothSideMargin }}">
        <!-- BEGIN HEADER -->
        @include('frontend.includes.header')
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        @if(isset($_G['route_name']) && $_G['route_name'] == 'home')
        <div style="height:5px; background-color:#ff8c34; padding-top: 80px;"></div>
        @endif
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container" >
            @if (!isset($_G['disable_sidemenu']) || $_G['disable_sidemenu'] != true)
                @include('frontend.includes.sidemenu')
            @endif
            @if( isset($_G['route_name']) && $_G['route_name'] == 'frontend.tailororders' )
                @include('frontend.includes.searchOption')
            @endif
            @if (isset($_G['disable_sidemenu']) && $_G['disable_sidemenu'] == true)
                @include('frontend.flash')
            @endif
            @yield('content')
        </div>
        <!-- END CONTAINER -->
        @include('frontend.includes.footer')
        @include('frontend.includes.footscript')
        @section('footer') @show
        @include('frontend.includes.modal')
        {!! Form::open(['id' => 'p-key-form']) !!}
        {!! Form::close() !!}
        @include('frontend.includes.member')
    </body>
</html>