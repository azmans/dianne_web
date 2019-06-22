@extends('layouts.dashboard')

@section('title', 'Income | DIANNE')

@section('content')
    <div class="container" style="margin-top: 10%">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>My Payments</h3>
                <div class="table-responsive">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <th>Client</th>
                            <th>Payment Type</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        @forelse ($lists as $list)
                            <tr>
                                <td>{{ $list->bride_first_name }} {{ $list->bride_last_name }} &
                                    {{ $list->groom_first_name }} {{ $list->groom_last_name }}</td>
                                <td>{{ $list->payment_type }}</td>
                                <td>{{ $list->status }}</td>
                                <td><a href="#" class="btn btn-custom btn-sm" data-toggle="modal" data-target="#income_details">Details</a></td>
                                <td><a href="/vendor/{{ $list->id }}/income/edit" class="btn btn-custom btn-sm">Edit</a></td>
                                <td><a href="#" class="btn btn-danger btn-sm">Delete</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No payment transactions entered.</td>
                                <a class="btn button_1" role="button" href="/vendor/{{ $list->id }}/income/add">Add Income</a>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if (!$lists->isEmpty())
    <div class="modal fade" id="income_details" tabindex="-1" role="dialog" aria-labelledby="details" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="details">Payment Transaction Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($lists as $list)
                    <table class="table">
                        <tr>
                            <th>Client:</th> <td>{{ $list->bride_first_name }} {{ $list->bride_last_name }}
                            & {{ $list->groom_first_name }} {{ $list->groom_last_name }}</td>
                        </tr>
                        <tr>
                            <th>Payment Type:</th> <td>{{ $list->payment_type }}</td>
                        </tr>
                        <tr>
                            <th>Amount:</th> <td>{{ $list->amount }}</td>
                        </tr>
                        <tr>
                            <th>Full or Installment:</th> <td></td>
                        </tr>
                        <tr>
                            <th>Date of Payment:</th> <td>{{ $list->date_paid }}</td>
                        </tr>
                    </table>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection