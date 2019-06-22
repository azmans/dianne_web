@extends('layouts.dashboard')

@section('title', 'Guest List Manager | DIANNE')

@section('content')
    <div class="container-fluid" style="margin-top: 10%">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
            <h3 style="text-align: center">Manage Guests</h3>
                <div class="row justify-content-center">
                    <div class="card col-lg-6">
                        @if(!$guests->isEmpty())
                            @foreach($guests as $guest)
                            <br>
                            <p>Guests Attending: {{ $guest->attending }}</p>
                            <p>Plus Ones: {{ $guest->additional }}</p>
                            <p>Total Guests: {{ $guest->total }}</p>
                            <br>
                            <p>Did not RSVP: {{ $guest->pending }}</p>
                            <p>Guests Not Attending: {{ $guest->declined }}</p>
                            @endforeach
                        @else
                            <br>
                            <p>Guests Attending:</p>
                            <p>Plus Ones:</p>
                            <p>Total Guests:</p>
                            <br>
                            <p>Did not RSVP:</p>
                            <p>Guests Not Attending:</p>
                        @endif
                    </div>
                </div>
            <h4>Total Guests Listed</h4>
            <a role="button" class="btn button_1" href="/guestlist/export">Export to PDF</a>
            <a role="button" class="btn button_1 float-right" href="/guestlist/{{ Auth::id() }}/meals">Set Meals</a>
            <a role="button" class="btn button_1 float-right" href="/guestlist/{{ Auth::id() }}/guest">Add Guest</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$details->isEmpty())
                        @foreach($details as $detail)
                        <tr>
                            <td>{{ $detail->first_name }} {{ $detail->last_name }}</td>
                            <td>{{ $detail->status }}</td>
                            @if($detail->status == 'Invite Not Sent')
                            <td><a href="/guestlist/{{ $detail->id }}/send" class="btn btn-custom btn-sm">Send RSVP</a></td>
                            @elseif($detail->status != 'Invite Not Sent')
                            <td></td>
                            @endif
                            <td><a href="#" class="btn btn-custom btn-sm" data-toggle="modal" data-target="#guest_details-{{ $detail->id }}">Details</a></td>
                            <td><a href="/guest/{{ $detail->id }}/edit" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                            <td><a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="4">You have not added any guests to your list yet.</td>
                    </tr>
                    @endif
                    </tbody>
                </table>
                {{ $details->links() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if (!$details->isEmpty())
        @foreach($details as $detail)
        <div class="modal fade" id="guest_details-{{ $detail->id }}" tabindex="-1" role="dialog" aria-labelledby="details" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="details">Guest Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><b>Name: </b>{{ $detail->first_name }} {{ $detail->last_name }}</p>
                        <p><b>Email: </b> {{ $detail->email }}</p>
                        <p><b>Choice of Meal: </b>{{ $detail->meal_type }}</p>
                        <p><b>Plus One: </b>
                        @if($detail->plus_one == 1)
                            Yes
                        @else
                            No
                        @endif
                        </p>
                        <p><b>Allergies: </b>
                            @if(!is_null($detail->allergy))
                                {{ decrypt($detail->allergy) }}
                            @else
                                None
                            @endif
                        </p>
                        <p><b>Status: </b>{{ $detail->status }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
@endsection