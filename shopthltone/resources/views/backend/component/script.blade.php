<!-- Mainly scripts -->
<script src="{{asset('backend/js/libraries/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('backend/js/libraries/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('backend/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('backend/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('backend/js/libraries/inspinia.js')}}"></script>
<script src="{{asset('backend/js/plugins/pace/pace.min.js')}}"></script>

@if (isset($config['script']) && is_array($config['script']))
@foreach ($config['script'] as $it)
    {!! '<script src="'.$it.'"></script>' !!}
@endforeach
@endif
<script>
	var BASE_URL = '{{asset("")}}';
	var SUFFIX = '{{config("apps.general.suffix")}}';
</script>
