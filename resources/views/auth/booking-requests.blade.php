@extends('layouts.dashboard')

@section('title', 'Booking Requests | DIANNE')

@section('content')
    <div class="container" style="margin-top: 10%">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Booking Requests</h3>
                <div class="table-responsive">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <th>Vendor</th>
                            <th>Date and Time</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @forelse ($lists as $list)
                            <tr>
                                <td>{{ $list->first_name }} {{ $list->last_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($list->date)->format('d F Y') }} {{ \Carbon\Carbon::parse($list->time)->format('h:m A') }}</td>
                                <td>{{ $list->status }}</td>
                                <td><a href="#" class="btn btn-custom btn-sm" data-toggle="modal" data-target="#booking_details-{{ $list->id }}">Details</a></td>
                                @if(is_null($list->cancel_date))
                                <td><a href="/booking-requests/{{ $list->vendor_id }}/cancel" class="btn btn-danger btn-sm" onclick="return cancel();">Cancel Booking</a></td>
                                @else
                                <td></td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No appointments booked.</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if (!$lists->isEmpty())
    @foreach($lists as $list)
    <div class="modal fade" id="booking_details-{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="details" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="details">Booking Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th>Vendor Name:</th> <td>{{ $list->first_name }} {{ $list->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Vendor Type:</th> <td>{{ $list->vendor_type }}</td>
                        </tr>
                        <tr>
                            <th>Company:</th> <td>{{ $list->company_name }}</td>
                        </tr>
                        <tr>
                            <th>Mobile:</th> <td>{{ $list->mobile }}</td>
                        </tr>
                        <tr>
                            <th>Date and Time of Appointment:</th> <td>{{ $list->date }} {{ $list->time }}</td>
                        </tr>
                        <tr>
                            <th>Details:</th> <td>{{ $list->details }}</td>
                        </tr>
                        <tr>
                            <td>Requested at: {{ $list->created_at }}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif

    <script type="text/javascript">
        function cancel() {
            confirm('Are you sure you want to cancel this booking?');
        }
    </script>
@endsection