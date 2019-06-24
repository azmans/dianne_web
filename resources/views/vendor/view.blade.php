@extends('layouts.home')

@section('title', 'Soon To Wed Profile | DIANNE')

@section('content')
    <section id="profile">
        <div class="col-sm-8 main-section container">
            <div class="profile-container">
                <div class="content">
                    <br>
                    <h4>Soon-to-Wed's Profile</h4>
                    <br>
                    <br>
                    <p>{{ $profile->bride_first_name }} {{ $profile->bride_last_name }} & {{ $profile->groom_first_name }} {{ $profile->groom_last_name }}</p>
                    <p>Getting Married on: {{ \Carbon\Carbon::parse($profile->wedding_date)->format('d F Y')}}</p>
                </div>

                <!-- make photo mobile responsive-->
                <div class="profile-picture">
                    <img class="profile-pic img-responsive" src="/storage/images/{{ $profile->profile_picture }}">

                    <div class="upload-pic">
                        <a class="btn btn-danger" role="button" href="/report/soon-to-wed/{{ $profile->id }}">Report User</a>
                    </div>
                </div>
                <div class="stwbuttons">
                    <a class="btn button_1" role="button" href="/vendor/clients">Back</a>
                    <a href="#">
                        <button type="submit" class="btn button_1" value="Submit" id="chatbutton">Chat</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection