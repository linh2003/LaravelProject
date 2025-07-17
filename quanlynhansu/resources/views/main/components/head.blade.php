<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{csrf_token()}}">
<title>Admin index</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/libraries/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/libraries/icofont.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/libraries/feather.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/libraries/style.css')}}">
@if(isset($config['css']))
@foreach ($config['css'] as $item)
    {!! '<link rel="stylesheet" type="text/css" href="'.$item.'" />' !!}
@endforeach
@endif

<link rel="stylesheet" type="text/css" href="{{asset('backend/css/customize.css')}}">