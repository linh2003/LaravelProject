
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{csrf_token()}}">

<title>INSPINIA | Dashboard v.2</title>

<link href="{{asset('backend/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

<link href="{{asset('backend/css/animate.css')}}" rel="stylesheet">
<link href="{{asset('backend/css/style.css')}}" rel="stylesheet">

@if (isset($config['css']) && is_array($config['css']))
@foreach ($config['css'] as $it)
    {!! '<link href="'.$it.'" rel="stylesheet">' !!}
@endforeach
@endif
<link href="{{asset('backend/css/customize.css')}}" rel="stylesheet">
