@extends('layouts.vendordashboard')

@section('title', 'My Clients | DIANNE')

@section('content')
    <div class="container" style="margin-top: 5%">
        <div class="row col-lg-offset-3">
            <div class="col-lg-12">
                <div class="card" style="padding: 5%;">
                    <h3>My Clients</h3>
                    <div class="table-responsive">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                              {{ session('message') }}
                          </div>
                       @endif

                       <table class="table">
                         <tr>
                             <th>Bride</th>
                             <th>Groom</th>
                             <th></th>
                             <th></th>
                             <th></th>
                        </tr>
                        @forelse ($lists as $list)
                            <tr>
                                <td>{{ $list->bride_first_name }} {{ $list->bride_last_name }}</td>
                                <td>{{ $list->groom_first_name }} {{ $list->groom_last_name }}</td>
                                <td><a href="#" class="btn btn-custom btn-sm" data-toggle="modal" data-target="#client_details-{{ $list->id }}">Details</a></td>
                                <td><a href="/view/soon-to-wed/{{ $list->id }}" class="btn btn-custom btn-sm">View Profile</a></td>
                                <td><a href="/vendor/client/{{ $list->id }}/edit" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No saved clients found.</td>
                            </tr>
                        @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if(!$lists->isEmpty())
    <div class="modal fade" id="client_details-{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="details" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="details">Client Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($lists as $list)
                        <h4>
                            {{ $list->bride_first_name }} {{ $list->bride_last_name }}
                            &
                            {{ $list->groom_first_name }} {{ $list->groom_last_name }}
                        </h4>
                        <p><b>Wedding Date:</b> {{ \Carbon\Carbon::parse($list->wedding_date)->format('d F Y')}}</p>
                        <br>
                        <p><b>Booking Date:</b> {{ \Carbon\Carbon::parse($list->date)->format('d F Y')}}</p>
                        <p><b>Booking Time:</b> {{ \Carbon\Carbon::parse($list->time)->format('g:i A')}}</p>
                        <br>
                        <p>
                            <b>Full or Installment:</b>
                            @if($list->fully_paid == 1)
                                Full
                            @elseif($list->deposit_paid == 1)
                                Deposit
                            @endif
                        </p>
                        <p><b>Notes:</b> {{ $list->notes }}</p>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection