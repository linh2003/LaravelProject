<div class="ibox float-e-margins">
	<div class="ibox-title">
		<h5>{{$heading['create']['titleBoxRight']}}</h5>
	</div>
	<div class="ibox-content" id="data_5">
		@php 
			$start = isset($promotion) ? formatDate($promotion->start, 'd/m/Y') : ''; 
			$end = isset($promotion) ? formatDate($promotion->end, 'd/m/Y') :''; 
		@endphp
		<div id="data_picker" class="input-daterange">
			<div class="form-group">
				<label class="font-normal">{{$heading['create']['field']['startDate']}}</label>
				<div class="input-group date">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="start" value="{{old('start', $start) ?? Carbon\Carbon::today()->format('d/m/Y')}}" readonly>
				</div>
			</div>
			<div class="">
				<label class="font-normal">{{$heading['create']['field']['endDate']}}</label>
				<div class="input-group date">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="end" value="{{old('end', $end) ?? Carbon\Carbon::today()->format('d/m/Y')}}" readonly>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ibox float-e-margins">
	<div class="ibox-title">
		<h5>{{$heading['create']['titleBoxRightBottom']}}</h5>
	</div>
	<div class="ibox-content">
		<select name="status" class="form-control">
		@foreach($general['promotion'] as $k => $val)
			<option value="{{$k}}" {{old('status', $promotion->status ?? null) == $k ? 'selected' : ''}}>{{$val}}</option>
		@endforeach
		</select>
	</div>
</div>