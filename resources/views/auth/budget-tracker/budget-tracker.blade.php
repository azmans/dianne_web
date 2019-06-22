@extends('layouts.dashboard')

@section('title', 'Budget Tracker | DIANNE')

@section('content')
    <div class="container-fluid" style="margin-top: 10%">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
            <h3 style="text-align: center">Budget Tracker</h3>
                <div class="row justify-content-center">
                    <div class="card col-lg-6">
                        <br>
                        @if(!$results->isEmpty())
                            @foreach($results as $result)
                            <h5>Budget: &#8369;{{ $result->budget }}</h5>
                                @if($lists->isNotEmpty())
                                <p>Total Amount Spent: &#8369;{{ $result->used }}</p>
                                <p>Remaining Balance: &#8369;{{ $result->difference }}</p>
                                @endif
                            <a class="btn button_1" href="/budget-tracker/{{ Auth::id() }}/budget/edit">Edit Budget</a>
                            @endforeach
                        @else
                            <p>You have not added a budget yet.</p>
                            <a class="btn button_1" href="/budget-tracker/{{ Auth::id() }}/budget/add">Add Budget</a>
                        @endif
                    </div>
                </div>
            <h4>List</h4>
            <a role="button" class="btn button_1" href="/budget-tracker/export">Export to PDF</a>
            <a role="button" class="btn button_1 float-right" href="/budget-tracker/{{ Auth::id() }}/item">Add Item</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Vendor Name</th>
                        <th>Type</th>
                        <th>Cost</th>
                        <th>Paid</th>
                        <th>Notes</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$lists->isEmpty())
                        @foreach($lists as $list)
                            <tr>
                                <td>{{ $list->budget_item }}</td>
                                <td>{{ $list->first_name }} {{ $list->last_name }}</td>
                                <td>{{ $list->vendor_type }}</td>
                                <td>P{{ $list->cost }}</td>
                                <td>
                                @if ($list->is_paid == 0)
                                    No
                                @else
                                    Yes
                                @endif
                                </td>
                                <td>{{ $list->notes }}</td>
                                <td><a href="/budget-tracker/{{ $list->id }}/item/edit" class="btn btn-primary btn-sm">Edit</a></td>
                                <td><a href="#" class="btn btn-danger btn-sm">Delete</a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">You have not added any items to your budget list yet.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection