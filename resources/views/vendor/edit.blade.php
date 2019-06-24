@extends('layouts.dashboard')

@section('title', 'Edit Profile | DIANNE')

@section('content')
    <div class="row col-lg-offset-3">
        <div class="col-lg-12">
            <div class="card">
                <form method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body col-lg-5">
                        <br>
                        <div class="form-group">
                            First Name:
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                   value="{{ $profile->first_name }}"/>
                        </div>

                        <div class="form-group">
                            Last Name:
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                   value="{{ $profile->last_name }}"/>
                        </div>

                        <div class="form-group">
                            Email:
                            <input type="email" class="form-control" id="email" name="email"
                                   placeholder="Email" value="{{ $profile->email }}"/>
                        </div>

                        <div class="form-group">
                            <label for="mobile">Mobile:</label>
                            <input type="number" class="form-control" id="mobile" name="mobile"
                                   placeholder="Mobile" value="{{ $profile->mobile }}"/>
                        </div>

                        <div class="form-group">
                            City:
                            <input type="text" class="form-control" id="city" name="city" placeholder="City"
                                   value="{{ $profile->city }}">
                        </div>

                        <div class="form-group">
                            Price Range:
                            <select class="form-control" id="price_range" name="price_range" required>
                                <option>Budget</option>
                                <option>Midrange</option>
                                <option>Highend</option>
                            </select>
                        </div>

                        <div class="buttons row" style="margin-top: 20%">
                            <button type="submit" class="btn btn-custom">Save Profile</button>
                            <a class="btn btn-custom" role="button" href="/vendor/dashboard">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection