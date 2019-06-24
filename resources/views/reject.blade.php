@extends('layouts.index')

@section('title', 'Compose Rejection Mail | DIANNE')

@section('content')
<section class="main">
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <form method="POST">
                @csrf

                <div class="form-group row">
                    <label for="reject">Please state your reason for rejecting this request.</label>
                    <textarea class="form-control" id="reject" name="reject" rows="3" required></textarea>
                </div>

                <div class="row">
                    <div class="col-sm">
                        <button type="submit" class="btn button_1" value="Submit">Reject</button>
                    </div>
                    <div class="col-sm">
                        <a href="/vendor/bookings/" class="btn button_1">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
