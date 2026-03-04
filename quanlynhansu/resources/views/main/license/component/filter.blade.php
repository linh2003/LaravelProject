<form method="GET" action="">
    <div class="row">
        <div class="form-group col-sm-3 col-xs-12 pl-0 mb-0">
			<input type="hidden" name="id" value="{{request('id') ?? old('id')}}" />
            <div><label class="col-form-label">{{__('license.index.filter.user')}}</label></div>
            <select class="form-control setupSelect2" name="user_id">
                <option value="">-- Choosen --</option>
            @foreach($users as $u)
                <option value="{{$u->id}}" {{(request('user_id') ?? old('user_id')) == $u->id ? 'selected' : ''}}>{{$u->name}}</option>
            @endforeach
            </select>
        </div>
        <div class="form-group col-sm-5 col-xs-12 pl-0 mb-0">
            <div><label class="col-form-label">{{__('license.index.filter.date_range')}}</label></div>
            <div class="d-flex">
                <div class="input-group date mb-0" id="start_date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" name="start_date" value="{{request('start_date') ?? old('start_date')}}">
                </div>
                <span class="date-to">to</span>
                <div class="input-group date mb-0" id="end_date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control" name="end_date" value="{{request('end_date') ?? old('end_date')}}">
                </div>
            </div>
        </div>
        <div class="form-group col-sm-2 col-xs-12 p-0 mb-0">
        @foreach($fields as $field)
            @if($field->field_code != 'license_status_term_id') @continue @endif
            <label class="col-form-label">{{$field->name}}</label>
            <select class="form-control" name="{{$field->field_code}}">
            @if(isset($field->terms) && count($field->terms))
                @foreach($field->terms as $term)
                    <option value="{{$term->id}}" {{(request($field->field_code) ?? old($field->field_code)) == $term->id ? 'selected' : ''}}>{{$term->name}}</option>
                @endforeach
            @endif
            </select>
        @endforeach
        </div>
        <div class="form-group col-sm-1 col-xs-12 pr-0 mb-0">
            <label class="col-form-label">{{__('general.filter.paginate')}}</label>
            <select class="form-control" name="perpage">
            @foreach(config('apps.general.paginate') as $item)
                @php $key = strtolower($item) @endphp
                <option value="{{$key}}" {{(request('perpage') ?? old('perpage')) == $key ? 'selected' : ''}}>{{$item}}</option>
            @endforeach
            </select>
        </div>
        <div class="form-group col-sm-1 col-xs-12 pr-0 mb-0">
            <label class="col-form-label">&nbsp;</label>
            <button type="submit" class="btn btn-outline-primary waves-effect waves-light">{{__('general.button.filter')}}</button>
        </div>
    </div>
</form>