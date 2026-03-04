<table class="table table-bordered dataTableData">
	<thead>
		<tr>
			<th width="30px" class="text-center align-middle">#</th>
			<th>Term</th>
			@include('main.module.component.language-column')
			<th class="text-center align-middle">Vocabulary</th>
			<th width="50px" class="text-center align-middle">Action</th>
		</tr>
	</thead>
	<tbody>
		@php $i = 1 @endphp
		@foreach($terms as $item)
		@if($item[0]['term'] != null)
		<tr>
			<td class="text-center align-middle">{{($i++)}}</td>
			@foreach($item as $key => $term)
			@if($key == 0)
				@if($term['term'] != null)
				<td class="align-middle">
					<h5 class="name">{{$term['term']->name}}</h5>
					@if($term['term']->description != null)<p class="description"><small><i>{{$term['term']->description}}</i></small></p>@endif
				</td>
				@endif
			@else
				<td class="text-center align-middle">
					<a href="{{route('language.translate', ['id' => $item[0]['term']->id, 'languageid' => $term['language'], 'model' => 'term'])}}">{{($term['term'] != null) ? __('term.view.translate.yes') : __('term.view.translate.no')}}</a>
				</td>
			@endif
			@endforeach
			<td class="text-center align-middle">
				<a href="{{route('vocabulary.edit', $item[0]['term']->vocid)}}">{{$item[0]['term']->vocname}}</a>
			</td>
			<td class="text-center align-middle">
				<div class="dropdown-primary dropdown dropdown-action">
					<a href="javascript:void(0)" class="dropdown-toggle btn btn-info" data-toggle="dropdown">{{__('general.button.edit')}}</a>
					<ul class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
						<li>
							<a href="{{route('term.edit', $item[0]['term']->id)}}" class="action-item">{{__('general.button.edit')}}</a>
						</li>
						<li>
							<a href="{{route('term.delete', $item[0]['term']->id)}}" class="action-item">{{__('general.button.delete')}}</a>
						</li>
					</ul>
				</div>
			</td>
		</tr>
		@endif
		@endforeach
	</tbody>
</table>