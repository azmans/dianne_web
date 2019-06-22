@extends('layouts.home')

@section('title', 'Edit Payment Record | DIANNE')

@section('content')
    <div class="container" style="margin-top: 10%">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
            <h3 style="text-align: center">Edit Payment Record</h3>
            <hr>
                <form method="POST">
                 @csrf

                    <div class="form-group">
                        <label for="payment_type">Payment Type</label>
                        <select class="form-control" name="payment_type">
                            <option>Bank Deposit</option>
                            <option>Cash</option>
                            <option>Credit/Debit Card</option>
                            <option>Paypal</option>
                            <option>Remittance</option>
                        </select>
                    </div>

                    <div class="form-group form-check-inline">
                        <input class="form-check-input" type="radio" name="is_installment" id="is_installment" value="{{ $income->is_installment }}">
                        <label class="form-check-label" for="is_installment">Installment</label>
                    </div>

                    <div class="form-group form-check-inline">
                        <input class="form-check-input" type="radio" name="is_full" id="is_full" value="{{ $income->is_full }}">
                        <label class="form-check-label" for="is_full">Full Payment</label>
                    </div>

                    <div class="form-group">
                        <label for="vendor">Amount</label>
                        <input type="number" name="amount" id="amount" min="0" max="9999999999.99" class="form-control"
                               value="&#8369;{{ $income->amount }}"/>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" required>
                            <option>Paid</option>
                            <option>Not Paid</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date_paid">Date Paid</label>
                        <input type="date" class="form-control" name="date_paid" value="{{ $income->date_paid }}">
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <a href="/vendor/income" role="button" class="btn button_1">Back</a>
                        </div>
                        <div class="col-sm">
                            <button type="submit" class="btn button_1">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection