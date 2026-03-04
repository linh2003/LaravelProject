<table class="table table-bordered dataTableData">
	<thead>
		<tr>
			<th width="30px" class="text-center align-middle">#</th>
			<th width="34px">Vocabulary</th>
			@include('main.module.component.language-column')
			<th width="50px" class="text-center align-middle">Action</th>
		</tr>
	</thead>
	<tbody>
		@php $i = 1 @endphp
		@foreach($vocabularies as $item)
		@if($item[0]['voc'] != null)
		<tr>
			<td class="text-center align-middle">{{($i++)}}</td>
			@foreach($item as $key => $voc)
			@if($key == 0)
				@if($voc['voc'] != null)
				<td>
					<h5 class="name">{{$voc['voc']->name}}</h5>
					@if($voc['voc']->description != null)<p class="description"><small><i>{{$voc['voc']->description}}</i></small></p>@endif
				</td>
				@endif
			@else
				<td class="text-center align-middle">
					<a href="{{route('language.translate', ['id' => $item[0]['voc']->id, 'languageid' => $voc['language'], 'model' => 'vocabulary'])}}">{{($voc['voc'] != null) ? __('vocabulary.view.translate.yes') : __('vocabulary.view.translate.no')}}</a>
				</td>
			@endif
			@endforeach
			<td class="text-center align-middle">
				<div class="dropdown-primary dropdown dropdown-action">
					<a href="javascript:void(0)" class="dropdown-toggle btn btn-info" data-toggle="dropdown">{{__('general.button.edit')}}</a>
					<ul class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
						<li>
							<a href="{{route('vocabulary.edit', $item[0]['voc']->id)}}" class="action-item">{{__('general.button.edit')}}</a>
						</li>
						<li>
							<a href="{{route('vocabulary.delete', $item[0]['voc']->id)}}" class="action-item">{{__('general.button.delete')}}</a>
						</li>
						<li>
							<a href="javascript:void(0)" class="action-item quick-add-action" data-target="#quickAdd" data-toggle="modal" data-model="Term" data-model-id="{{$item[0]['voc']->id}}">{{__('vocabulary.button.quickterm')}}</a>
						</li>
						<li>
							<a href="javascript:void(0)" class="action-item sort-action" data-target="#sortAction" data-toggle="modal" data-model="Term" data-model-id="{{$item[0]['voc']->id}}">{{__('vocabulary.button.sortterm')}}</a>
						</li>
					</ul>
				</div>
			</td>
		</tr>
		@endif
		@endforeach
	</tbody>
</table>
<div class="modal fade" id="quickAdd">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">{{__('vocabulary.quickterm.title')}}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p style="color:red">(*)&nbsp;<small>{{__('vocabulary.quickterm.help')}}</small></p>
				<input type="hidden" class="model-id" value="" />
				<input type="hidden" class="model" value="" />
				<textarea class="form-control data" rows="6"></textarea>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary waves-effect actionQuickAdd" data-dismiss="modal">{{__('general.button.save')}}</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="sortAction">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">{{__('vocabulary.sortterm.title')}}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p style="color:red">(*)&nbsp;<small>{{__('vocabulary.sortterm.help')}}</small></p>
				<input type="hidden" class="model" value="Term" />
				<div class="nested-object">
					<textarea name="nestableobject" id="nestable-output" class="form-control nestable-output hide"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary waves-effect btnSortAction" data-dismiss="modal">{{__('general.button.save')}}</button>
			</div>
		</div>
	</div>
</div>