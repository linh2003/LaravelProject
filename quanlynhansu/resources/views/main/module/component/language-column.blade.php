@foreach($languages as $language)
@if($language->active == config('apps.general.publish')) @continue @endif
<th class="text-center align-middle" width="100px"><img src="{{asset($language->image)}}" alt="{{$language->name}}" class="icon-language" /></th>
@endforeach