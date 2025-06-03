@include('backend.component.breadcrumb',['breadcrumb_before'=>$heading['index']['title']])
<div class="wrapper wrapper-content animated fadeIn">
<form action="{{route('system.store')}}" method="POST">
	@csrf
	<div class="tabs-container mb40">
		<div class="tabs-left mb40">
	        <ul class="nav nav-tabs">
	        @php $i = 0; @endphp
	        @foreach($system as $k => $it)
	            <li class="{{$i == 0 ? 'active' : ''}}">
	            	<a data-toggle="tab" href="#tab-{{$k}}">
	            		<strong>{{$it['label']}}</strong>
	            		<p><small><i>{{$it['description']}}</i></small></p>
	            	</a>
	            </li>
	            @php $i++; @endphp
	        @endforeach
	        </ul>
	        <div class="tab-content ">
	        @php $i = 0; @endphp
	        @foreach($system as $key => $item)
	        	<div id="tab-{{$key}}" class="tab-pane {{$i == 0 ? 'active' : ''}}">
	                <div class="panel-body">
						@if(isset($item['value']))
						@foreach($item['value'] as $k => $it)
						@php $nameInput = $key.'_'.$k; $dataInput = (isset($data) && count($data)) ? $data : []; @endphp
						<div class="form-group">
							<label>{{$it['label']}}</label>
							{!! renderInputHtml($it['input'], $nameInput, $dataInput) !!}
						</div>
						@endforeach
						@endif
	                </div>
	            </div>
	            @php $i++; @endphp
	        @endforeach
	        </div>
	    </div>
		<div class="text-center">
			<button type="button" class="btn btn-white cancel_delete">{{$general['button']['cancel']}}</button>
			<button class="btn btn-primary" type="submit" name="send">
				<i class="fa fa-check"></i>
				<span>{{$general['button']['save']}}</span>
			</button>
		</div>
	</div>
</div>