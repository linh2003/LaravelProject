<base href="{{ config('app.url') }}" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1,user-scalable=0">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="index,follow"/>
<meta name="author" content="{{ $system['general_name'] }}"/>
<meta name="copyright" content="{{ $system['general_name'] }}" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="refresh" content="1800" />
<link rel="icon" href="{{ $system['general_favicon'] }}" type="image/png" sizes="30x30">
<!-- GOOGLE -->
<title>{{ $seo['meta_title'] }}</title>
<meta name="description"  content="{{ $seo['meta_description'] }}" />
<meta name="keyword"  content="{{ $seo['meta_keyword'] }}" />
<link rel="canonical" href="{{ $seo['canonical'] }}" />	
<meta property="og:locale" content="vi_VN" />
<!-- for Facebook -->
<meta property="og:title" content="{{ $seo['meta_title'] }}" />
<meta property="og:type" content="website" />
<meta property="og:image" content="{{ $seo['meta_image'] }}" />
<meta property="og:url" content="{{ $seo['canonical'] }}" />		
<meta property="og:description" content="{{ $seo['meta_description'] }}" />
@php
    $coreCss = [
        'backend/css/plugins/toastr/toastr.min.css',
        'frontend/resources/fonts/font-awesome-4.7.0/css/font-awesome.min.css',
        'frontend/resources/uikit/css/uikit.modify.css',
        'frontend/resources/library/css/library.css',
        'frontend/resources/plugins/wow/css/libs/animate.css',
        'frontend/core/plugins/jquery-nice-select-1.1.0/css/nice-select.css',
        'frontend/resources/style.css',
    ];
    if(isset($config['css'])){
        foreach($config['css'] as $key => $val){
            array_push($coreCss, $val);
        }
    }
	$coreCss[] = 'frontend/css/custom.css';
@endphp
@foreach ($coreCss as $item)
    <link rel="stylesheet" href="{{ asset($item) }}">
@endforeach
<script src="{{ asset('backend/js/libraries/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('backend/js/libraries/bootstrap.min.js') }}"></script>
<!-- <script src="{{ asset('frontend/resources/library/js/jquery.js') }}"></script> -->

