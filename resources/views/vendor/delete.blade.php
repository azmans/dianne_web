@extends('layouts.home')

@section('title', 'Delete Account | DIANNE')

@section('content')
    <div class="container" style="margin-top: 10%">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form method="POST">
                 @csrf

                    <div class="form-group">
                        <h3 style="font-color: red">Are you sure you want to delete your account?</h3>
                    </div>

                    <div class="form-group">
                        <p>All of your information will be deleted.</p>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <a href="/vendor/dashboard" role="button" class="btn btn-primary">Back</a>
                        </div>
                        <div class="col-sm">
                            <button type="submit" class="btn btn-danger">Delete Your Account</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection