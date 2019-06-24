@extends('layouts.vendordashboard')

@section('title', 'Manage Bookings | DIANNE')

@section('content')
    <div class="container" style="margin-top: 5%">
    <div class="row col-lg-offset-3">
        <div class="col-lg-12">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Soon-to-weds</th>
                            <th>Date and Time of Requested Appointment</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $booking->bride_first_name }} {{ $booking->bride_last_name }} & {{ $booking->groom_first_name }} {{ $booking->groom_last_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->date)->format('d F Y') }} {{ \Carbon\Carbon::parse($booking->time)->format('h:m A') }}</td>
                            <td>{{ $booking->status }}</td>
                            @if(!$booking->status == 'Rejected')
                            <td><a href="#" class="btn btn-danger btn-sm">Cancel Booking</a></td>
                            @else
                            <td><a href="#" class="btn btn-secondary btn-sm">Archive</a></td>
                            @endif
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4">No bookings accepted at the moment.</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection