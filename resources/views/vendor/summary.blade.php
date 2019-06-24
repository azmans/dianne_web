@extends('layouts.vendordashboard')

@section('title', 'Summary | DIANNE')

@section('content')
    <div class="content" id="summary" style="margin-top: 8%">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <h3>Summary</h3>
                            <div class="form-group">
                                <label for="start">Summary date:</label>
                                <input type="date" id="start" name="summary-date" class="form-control"
                                       value="2018-07-22"
                                       min="2018-01-01" max="2080-12-31">

                                <button class="btn button_1 sumbtn">View</button>
                                <button class="btn button_1 sumbtn">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card card-stats" id="budgetcard">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4 summaryicon">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-money-coins text-success"></i>
                                </div>
                            </div>

                            <div class="col-7 col-md-8">
                                <div class="" id="card-header">
                                    <h4 class="">Bookings</h4>
                                </div>
                            </div>
                            @if(!$bookings->isEmpty())
                            <div class="col-7 col-md-8" id="vendorsummarybookings">
                                <div class="numbers">
                                    <p class="card-category" id="budgetlabel">Accepted</p>
                                    <p class="card-title">14<p>
                                </div>
                                <div class="numbers">
                                    <p class="card-category" id="budgetlabel">Rejected</p>
                                    <p class="card-title">2<p>
                                </div>
                                <div class="numbers">
                                    <p class="card-category" id="budgetlabel">Pending</p>
                                    <p class="card-title">8</p>
                                </div>
                            </div>
                            @else
                                <p>No bookings found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning summaryicon">
                                    <i class="nc-icon nc-vector text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="" id="card-header">
                                    <h4 class="">Clients & Income</h4>
                                </div>
                            </div>
                            <div class="col-7 col-md-8" id="guestcard">
                                <div class="numbers">
                                    <p class="card-category" id="label">Total Number of Clients</p>
                                    <p class="card-title" id="num">50<p>
                                </div>
                                <div class="numbers">
                                    <p class="card-category" id="label">Total Income This Month (Credit Card)</p>
                                    <p class="card-title" id="num">p3000<p>
                                </div>
                                <div class="numbers">
                                    <p class="card-category" id="label">Total Income This Month (Cash & Bank Deposit)</p>
                                    <p class="card-title" id="num">p40000<p>
                                </div>
                                <hr>
                                <div class="label1">
                                    <div class="numbers">
                                        <p class="card-category" id="label">Total Income</p>
                                        <p class="card-title" id="num">p43000<p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Average Feedback</h5>
                    </div>
                    <div class="card-body ">
                        <div class="">
                            <table class="table" id="">
                                <thead class=" text-primary">
                                <th>
                                    Criteria
                                </th>
                                <th>
                                    Ave Rating
                                </th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        Value
                                    </td>
                                    <td>
                                        (Star) 4.5
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Promptness
                                    </td>
                                    <td>
                                        (Star) 4.5
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Quality
                                    </td>
                                    <td>
                                        (Star) 4.5
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Professionalism
                                    </td>
                                    <td>
                                        (Star) 4.5
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Overall
                                    </td>
                                    <td>
                                        (Star) 4.5
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                </div>

            </div>

        </div>

        <div class="row">
        </div>

    </div>
@endsection

