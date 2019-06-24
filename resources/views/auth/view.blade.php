@extends('layouts.home')

@section('title', 'Vendor Profile | DIANNE')

@section('content')
    <div class="container" style="margin-top: 10%">
        <section id="profile">
            <div class="col-sm-8 main-section container">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="profile-container">
                    <div class="left">
                        <div class="content" id="vendor-content">
                            <h4>Company Name: {{ $profile->company_name }}</h4>
                            <br>
                            <br>
                            <p>{{ $profile->first_name }} {{ $profile->last_name }}</p>
                            <p>{{ $profile->vendor_type }}</p>
                            <p>Price Range: {{ $profile->price_range }}</p>
                            <p>{{ $profile->city }}</p>
                        </div>

                        <div class="vendorbuttons">
                            <a class="btn viewportfolio" role="button" href="/vendor/{{ $profile->id }}/portfolio/view">View Portfolio</a>
                            <form method="POST">
                                @csrf
                                <a href="/request/profile/{{ $profile->id }}" role="button" class="btn button_1">Request Booking</a>
                            </form>
                            <a class="btn paybutton" role="button" href="/pay/vendor/{{ $profile->id }}">Pay Vendor</a>
                        </div>
                    </div>

                    <div class="right">
                        <div class="profile-picture">
                            @if(!is_null($profile->profile_picture))
                            <img class="profile-pic img-responsive" id="vendor-pic" src="/storage/images/{{ $profile->profile_picture }}">
                            @else
                                <img src="/img/user.png" id="vendor-pic" class="profile-pic img-responsive" alt="Avatar">
                            @endif
                        </div>

                        <div class="vendor_buttons">
                            <form method="POST" action="/save/profile/{{ $profile->id }}">
                                @csrf

                                <button type="submit" class="btn button_1">Save Vendor</button>
                            </form>
                            <a href="#">
                                <button type="submit" class="button_1" value="Submit">Chat</button>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="vendorratings">
                        <h1>Feedback</h1>
                        @forelse($feedbacks as $feedback)
                        <div class="rate">
                            <h5>Overall Rating</h5>
                            <span class="stars">
                                @foreach($feedbacks as $feedback)
                                    <p>{{ round($feedback->avg_overall, 1) }}</p>
                                    @php $rating = round($feedback->avg_overall, 1); @endphp
                                    @foreach(range(1,5) as $i)
                                        @if($rating > 0)
                                            @if($rating > 0.5)
                                                <i class="fa fa-star checked star"></i>
                                            @else
                                                <i class="fa fa-star-half-o checked star"></i>
                                            @endif
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                            @php $rating--; @endphp
                                    @endforeach
                                @endforeach
                            </span>
                        </div>

                        <div class="rate" id="value" name="value">
                            <h5>Value</h5>
                            <p>Value for money</p>
                            <span class="stars">
                                @foreach($feedbacks as $feedback)
                                    <p>{{ round($feedback->avg_value, 1) }}</p>
                                    @php $rating = round($feedback->avg_value, 1); @endphp
                                    @foreach(range(1,5) as $i)
                                        @if($rating > 0)
                                            @if($rating > 0.5)
                                                <i class="fa fa-star checked star"></i>
                                            @else
                                                <i class="fa fa-star-half-o checked star"></i>
                                            @endif
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                        @php $rating--; @endphp
                                    @endforeach
                                @endforeach
                            </span>
                        </div>

                        <div class="rate" id="prompt">
                            <h5>Promptness</h5>
                            <p>Ability to cater/serve to</p>
                            <span class="stars">
                                @foreach($feedbacks as $feedback)
                                    <p>{{ round($feedback->avg_promptness, 1) }}</p>
                                    @php $rating = round($feedback->avg_promptness, 1); @endphp
                                    @foreach(range(1,5) as $i)
                                        @if($rating > 0)
                                            @if($rating > 0.5)
                                                <i class="fa fa-star checked star"></i>
                                            @else
                                                <i class="fa fa-star-half-o checked star"></i>
                                            @endif
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                        @php $rating--; @endphp
                                    @endforeach
                                @endforeach
                            </span>
                        </div>

                        <div class="rate" id="quality">
                            <h5>Quality</h5>
                            <p>Quality of product/service</p>
                            <span class="stars">
                                @foreach($feedbacks as $feedback)
                                    <p>{{ round($feedback->avg_quality, 1) }}</p>
                                    @php $rating = round($feedback->avg_quality, 1); @endphp
                                    @foreach(range(1,5) as $i)
                                        @if($rating > 0)
                                            @if($rating > 0.5)
                                                <i class="fa fa-star checked star"></i>
                                            @else
                                                <i class="fa fa-star-half-o checked star"></i>
                                            @endif
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                        @php $rating--; @endphp
                                    @endforeach
                                @endforeach
                            </span>
                        </div>

                        <div class="rate" id="professionalism">
                            <h5>Professionalism</h5>
                            <p>Attitude</p>
                            <span class="stars">
                                @foreach($feedbacks as $feedback)
                                    <p>{{ round($feedback->avg_professionalism, 1) }}</p>
                                    @php $rating = round($feedback->avg_professionalism, 1); @endphp
                                    @foreach(range(1,5) as $i)
                                        @if($rating > 0)
                                            @if($rating > 0.5)
                                                <i class="fa fa-star checked star"></i>
                                            @else
                                                <i class="fa fa-star-half-o checked star"></i>
                                            @endif
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                        @php $rating--; @endphp
                                    @endforeach
                                @endforeach
                            </span>
                        </div>
                    @empty
                        <p>No reviews found for this vendor so far.</p>
                    @endforelse

                        <a class="btn button_1" role="button" href="/profile/{{ $profile->id }}/feedback">Leave Review</a>
                    </div>

                        <a class="btn reportbutton" href="/report/vendor/{{ $profile->id }}" role="button">Report Vendor</a>
                </div>
            </div>
        </section>
    </div>
@endsection