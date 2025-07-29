
<div class="card">
    <div class="profile-left-header p-3">
        <div class="profile-avatar d-flex justify-content-between align-items-end mb-3">
            <img src="{{old('image', isset($user->image) ? $user->image : null) ?? asset('backend/images/avatar-4.jpg')}}" alt="" class="img-radius" />
            @if(isset($user->social))
            <div class="profile-social icon-btn">
                @foreach($user->social as $icon => $href)
                <a href="{{$href}}" class="btn btn-icon waves-effect waves-light btn-facebook ml-1">
                    <i class="icofont {{$icon}}"></i>
                </a>
                @endforeach
            </div>
            @endif
        </div>
        @if(isset($user->name))<h5 class="profile-name">{{$user->name}}</h5>@endif
        <button type="button" class="btn btn-info image-target">Change</button>
        <input type="hidden" name="image" value="{{old('image', isset($user->image) ? $user->image : null)}}" />
    </div>
    <ul class="profile-summary">
        @if(isset($user->gender))
            <li>
                @if($user->gender == 1)
                <i class="icofont icofont-user-male"></i>&nbsp;&nbsp;{{__('general.gender.male')}}
                @else
                <i class="icofont icofont-user-female"></i>&nbsp;&nbsp;{{__('general.gender.female')}}
                @endif
            </li>
        @endif
        @if(isset($user->email))<li><i class="icofont icofont-email"></i>&nbsp;&nbsp;{{$user->email}}</li>@endif
        @if(isset($user->phone))<li><i class="icofont icofont-phone"></i>&nbsp;&nbsp;{{$user->phone}}</li>@endif
        @if(isset($user->birthday))<li><i class="icofont icofont-birthday-cake"></i>&nbsp;&nbsp;{{formatDate($user->birthday)}}</li>@endif
    </ul>
    
</div>