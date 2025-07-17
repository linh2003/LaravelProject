<table class="table table-bordered dataTableData">
    <thead>
        <tr>
            {!! renderTableHeadingHtml(__('user.index.column')) !!}
        </tr>
    </thead>
    <tbody>
    @foreach($users as $k => $user)
        <tr>
            <td class="text-center align-middle">
				<div class="checkbox-zoom zoom-primary">
					<label>
						<input type="checkbox" class="checkBoxItem" name="input[]" value="{{$user->id}}">
						<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
					</label>
				</div>
			</td>
            <td class="text-center align-middle">{{ ($k + 1) }}</td>
            <td class="align-middle">
                <div class="d-flex align-items-center">
                    <img src="{{asset('backend/images/avatar-4.jpg')}}" alt="" class="img-radius" />
					<div>&nbsp;&nbsp;&nbsp;</div>
                    <strong style="font-weight: 600">{{$user->name}}</strong>
                </div>
            </td>
            <td>
                <p class="mb-1"><i class="icofont icofont-envelope"></i>&nbsp;&nbsp; {{$user->email}}</p>
                <p class="mb-1"><i class="icofont icofont-smart-phone"></i>&nbsp;&nbsp; {{$user->phone}}</p>
            </td>
            <td class="text-center align-middle">
			@foreach($user->roles as $role)
				<label class="label label-info">{{$role->name}}</label>
			@endforeach
			</td>
            <td class="text-center align-middle switch-status-{{$user->id}}">
			@if($user->status == 1)
				<input type="checkbox" class="js-switch status" data-field="status" data-model="User" data-modelId="{{$user->id}}" value="{{$user->status}}" checked />
			@else
				<input type="checkbox" class="js-switch status" data-field="status" data-model="User" data-modelId="{{$user->id}}" value="{{$user->status}}" />
			@endif
			</td>
            <td class="text-center align-middle"></td>
            <td class="text-center align-middle">
				<div class="dropdown-primary dropdown dropdown-action">
					<a href="javascript:void(0)" class="dropdown-toggle btn btn-info" data-toggle="dropdown">{{__('general.button.edit')}}</a>
					<ul class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
						<li>
							<a href="{{route('user.edit', $user->id)}}">{{__('general.button.edit')}}</a>
						</li>
						<li>
							<a href="{{route('user.delete', $user->id)}}">{{__('general.button.delete')}}</a>
						</li>
					</ul>
				</div>
			</td>
        </tr>
    @endforeach
    </tbody>
</table>