@extends('layouts.dashboard')

@section('title', 'Dashboard | DIANNE')

@section('content')
<div class="row col-lg-offset-3">
    <div class="col-lg-12">
        <div class="card">
            @foreach($profiles as $profile)
            <div class="card-header">
                <br>
                <h5 class="card-title">{{ $profile->bride_first_name }} {{ $profile->bride_last_name }}
                    &
                    {{ $profile->groom_first_name }} {{ $profile->groom_last_name }}
                </h5>
            </div>

            <div class="card-body" style="position:relative">
                <p>Getting Married on: {{ \Carbon\Carbon::parse($profile->wedding_date)->format('d F Y') }}</p>
            </div>

            <div class="profile-picture">
                @if(!is_null($profile->profile_picture))
                <img class="profile-pic img-responsive" src="storage/images/{{ $profile->profile_picture }}">
                @else
                    <img class="profile-pic img-responsive" src="/img/user.png" width="250" height="250">
                @endif

                <form method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="upload">
                        <input type="file" accept="image/png, image/jpg, image/jpeg, image/gif" class="form-control-file" name="profile_picture" id="profile_picture">
                        <button type="submit" class="btn button_1">Update Picture</button>
                    </div>
                </form>

                <div class="buttons row">
                    <a href="/dashboard/edit/{{ Auth::id() }}" class="btn btn-custom">Edit Profile</a>
                    <a href="#" class="btn btn-danger">Delete Profile</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection