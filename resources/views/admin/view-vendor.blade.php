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
                            <a class="btn viewportfolio" role="button" href="/admin/view/vendor/{{ $profile->id }}/portfolio">View Portfolio</a>
                        </div>
                    </div>

                    <div class="right">
                        <div class="profile-picture">
                            <img class="profile-pic" id="vendor-pic" src="/storage/images/{{ $profile->profile_picture }}">
                        </div>

                        <div class="vendor_buttons">
                            <a class="btn button_1" role="button" href="/admin/dashboard">Back</a>
                            <a class="btn btn-danger" role="button" href="/admin/vendor/{{ $profile->id }}/blacklist">Blacklist</a>
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
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection