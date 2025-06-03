
@php
	$script = [
		'frontend/resources/uikit/js/uikit.min.js',
		'frontend/core/plugins/jquery-nice-select-1.1.0/js/jquery.nice-select.min.js',
		'frontend/js/setupNiceSelect.js',
		'frontend/resources/uikit/js/components/sticky.min.js',
	];
	if(isset($config['script']) && count($config['script'])){
		$script = array_merge($config['script']);
	}
@endphp
@foreach($script as $js)
<script src="{{asset($js)}}"></script>
@endforeach
<script>
	var BASE_URL = '{{asset("")}}';
	var SUFFIX = '{{config("apps.general.suffix")}}';
</script>