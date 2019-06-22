@extends('layouts.home')

@section('title', 'Add Income | DIANNE')

@section('content')
    <div class="container" style="margin-top: 10%">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

            <h3 style="text-align: center">Add a Payment Transaction</h3>
            <hr>
                <form method="POST">
                 @csrf

                    <div class="form-group">
                        <label for="client_name">Client</label>
                        <select class="form-control" name="soon_to_wed_id" required>
                            @foreach($user as $users)
                                <option value="{{ $user->id }}">{{ $users->bride_first_name }} {{ $users->bride_last_name }}
                                & {{ $users->groom_first_name }} {{ $users->groom_last_name }}</option>
                            @endforeach
                        </select>
                        <small>*If the client you have received income from is not listed above, please make sure they are saved to your list of clients.</small>
                    </div>

                    <div class="form-group">
                        <label for="payment_type">Payment Type</label>
                        <select class="form-control" name="payment_type" required>
                            <option>Bank Deposit</option>
                            <option>Cash</option>
                            <option>Credit/Debit Card</option>
                            <option>Paypal</option>
                            <option>Remittance</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" required>
                            <option>Paid</option>
                            <option>Not Paid</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <a href="/vendor/income" role="button" class="btn button_1">Back</a>
                        </div>
                        <div class="col-sm">
                            <button type="submit" class="btn button_1">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection