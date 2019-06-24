@extends('layouts.home')

@section('title', 'Vendor Marketplace | DIANNE')

@section('content')
    <div class="container-fluid padding" style="margin-top: 10%">
        <div class="row features text-left">
            <div class="sidenav">
                <h6>Vendor Categories</h6>
                    <a href="#">Bridal Salon</a>
                    <a href="#">Beauty Salon</a>
                    <a href="#">Entertainment</a>
                    <a href="#">Jewelers</a>
                    <a href="#">Venue</a>
                    <a href="#">Photographers</a>
                    <a href="#">Videographers</a>
                    <a href="#">Officiants</a>
                    <a href="#">Caterers</a>
                    <a href="#">Bar Service</a>
                    <a href="#">Florist</a>
                    <a href="#">Photobooths</a>
                    <a href="#">Decor</a>
                    <a href="#">Transportation</a>
                    <a href="#">Invitations</a>
                    <a href="#">Wedding Favors</a>
                    <a href="#">Wedding Planners</a>
                    <a href="#">Others</a>
                    <br>
                <h6>Price Range</h6>
                    <select name="price">
                        <option value="p">&#8369;</option>
                        <option value="pp">&#8369;&#8369;</option>
                        <option value="ppp">&#8369;&#8369;&#8369;</option>
                    </select>
                </div>
            </div>
        </nav>


            <div class="row">
                @foreach($items as $item)
                <div class="column">
                    <div class="card">
                        @if(!is_null($item->profile_picture))
                        <img src="storage/images/{{ $item->profile_picture }}" width="70" height="130" class="imgcenter img-responsive" alt="Avatar">
                        @else
                            <img src="/img/user.png" width="70" height="130" class="imgcenter img-responsive" alt="Avatar">
                        @endif
                        <p class="vendorname">{{ $item->first_name }} {{ $item->last_name }}</p>
                        <p class="vendortype">{{ $item->vendor_type }}</p>

                        <p>
                            @if($item->price_range == 'Budget')
                                &#8369;
                            @elseif($item->price_range == 'Midrange')
                                &#8369;&#8369;
                            @elseif($item->price_range == 'Highend')
                                &#8369;&#8369;&#8369;
                            @endif
                        </p>

                        <p><a href="/view/profile/{{ $item->id }}" role="button" class="btn button_1">View Profile</a></p>
                    </div><br>
                </div>
                @endforeach
            </div>
            {{ $items->links() }}
    </div>

@endsection