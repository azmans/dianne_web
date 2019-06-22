@extends('layouts.vendordashboard')

@section('title', 'Dashboard | DIANNE')

@section('content')
<div class="row col-lg-offset-3" style="margin-top: 5%">
    <div class="col-lg-12">
        <div class="card">
            @foreach($profiles as $profile)
                <div class="card-header">
                    <br>
                    <h5 class="card-title">{{ $profile->first_name }} {{ $profile->last_name }}</h5>
                    <p class="card-category">{{ $profile->email }}
                    <br>{{ $profile->mobile }}</p>
                </div>

                <div class="card-body">
                    <h5>{{ $profile->company_name }}</h5>
                    <p>Vendor Type: {{ $profile->vendor_type }}</p>
                    <p>{{ $profile->city }}</p>
                    <p>Price Range: {{ $profile->price_range }}</p>
                    <br>
                    <p>SEC/DTI Number: {{ $profile->sec_dti_number }}</p>
                    <p>TIN: {{ $profile->tin }}</p>
                    <p>Mayor's Permit: {{ $profile->mayors_permit }}</p>
                    <div class="buttons row">
                        <a href="/vendor/dashboard/edit/{{ $profile->id }}" class="btn button_1">Edit Profile</a>
                        <a href="#" class="btn button_1" role="button">Delete Profile</a>
                    </div>
                </div>

                <div class="profile-picture" style="margin-bottom: 8%">
                    <img class="profile-pic img-responsive" id="vendorprofilepic" src="/storage/images/{{ $profile->profile_picture }}">

                    <form method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="upload-pic">
                            <input type="file" accept="image/png, image/jpg, image/jpeg, image/gif" class="form-control-file" name="profile_picture" id="profile_picture">
                        </div>
                        <div class="row" style="margin-top: 40%">
                            <button type="submit" class="btn button_1">Update Picture</button>
                        </div>
                    </form>
                </div>

                @endforeach
        </div>
    </div>
</div>
@endsection