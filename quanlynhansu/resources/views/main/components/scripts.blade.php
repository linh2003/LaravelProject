<script type="text/javascript" src="{{asset('backend/js/libraries/jquery-3.7.1.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/libraries/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/libraries/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/libraries/popper.min.js')}}"></script> <!-- require for dropdown -->
<script type="text/javascript" src="{{asset('backend/js/libraries/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/libraries/pcoded.min.js')}}"></script> <!-- require for nav -->
<script type="text/javascript" src="{{asset('backend/js/libraries/menu-hori-fixed.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/libraries/script.js')}}"></script>
@if(isset($config['script']))
@foreach ($config['script'] as $item)
    {!! '<script type="text/javascript" src="'.$item.'"></script>' !!}
@endforeach
@endif

<script type="text/javascript">
	var BASE_URL = '{{asset("")}}';
	var SUFFIX = '{{config("apps.general.suffix")}}';
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>