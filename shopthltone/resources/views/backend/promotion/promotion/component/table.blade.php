@if(isset($promotion))
<div class="table-responsive">
	<div class="clear">
		<div class="row">
			<div class="col-sm-6">
				@if(count($promotion)>0) <p>{{$heading['index']['counter']}} {{$promotion->firstItem()}} - {{$promotion->lastItem()}} /{{$counter}} </p> @endif
			</div>
		</div>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				{!! renderTableHeadingHtml($heading['index']['columnHeading']) !!}
			</tr>
		</thead>
		<tbody>
		@if (isset($promotion))
			@foreach ($promotion as $k => $it)
			<tr>
				<td><input type="checkbox" class="checkBoxItem" name="input[]" value="{{$it->id}}"></td>
				<td class="text-center">{{ ($k + $promotion->firstItem()) }}</td>
				@php
					$due = (strtotime($it->end) - strtotime(now()) < 0) ? $heading['index']['label']['due'] : '';
				@endphp
				<td>
					<h3>{{ $it->name }}</h3> @if(!empty($due)) <span class="badge badge-danger">{{$due}}</span> @endif
					<small><b>{{$heading['index']['label']['code']}}</b>:&nbsp;<i style="color: red">{{ $it->code }}</i></small>
					<p>{{ $it->description }}</p>
				</td>
				@php 
					$start = formatDate($it->start, 'd/m/Y'); 
					$end = formatDate($it->end, 'd/m/Y'); 
				@endphp
				<td class="text-center">
				{{$heading['index']['label']['start']}} <span style="color: red">{{$start}}</span> {{$heading['index']['label']['end']}} <span style="color: red">{{$end}} </span>
				</td>
				<td class="text-center switch-status-{{$it->id}}">
				@if($it->status == 1)
					<input type="checkbox" class="js-switch status" data-field="status" data-model="Promotion" data-modelId="{{$it->id}}" value="{{$it->status}}" checked />
				@else
					<input type="checkbox" class="js-switch status" data-field="status" data-model="Promotion" data-modelId="{{$it->id}}" value="{{$it->status}}" />
				@endif
				</td>
				<td class="text-center" width="100px">
					<a href="{{ route('admin.promotion.edit',['id'=>$it->id]) }}" class="btn btn-outline btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
				</td>
			</tr>
			@endforeach
		@endif
		</tbody>
	</table>
	{{ $promotion->links('pagination::bootstrap-4') }}
</div>
@endif