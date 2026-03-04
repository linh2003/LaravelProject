<table class="table table-bordered">
	<thead>
		<tr>
			{!! renderTableHeadingHtml(__('license.index.column')) !!}
		</tr>
	</thead>
	<tbody>
	@if(isset($licenses) && count($licenses))
		@php $langCode = app()->getLocale(); @endphp
		@foreach($licenses as $index => $license)
		@php 
			$typeLang = $license->type_term?->languages->firstWhere('canonical', $langCode);
			$statusLang = $license->status_term?->languages->firstWhere('canonical', $langCode);
		@endphp
			<tr>
				<td class="text-center">{{ ($index + $licenses->firstItem()) }}</td>
				<td>{{$license->user->name}}</td>
				<td>{{$typeLang?->pivot->name}}</td>
				<td>{{$statusLang?->pivot->name}}</td>
				<td></td>
			</tr>
		@endforeach
	@endif
	</tbody>
</table>