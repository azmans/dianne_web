@extends('layouts.dashboard')

@section('title', 'Summary | DIANNE')

@section('content')
    <div class="content" id="summary">
        <div class="row">
           <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                   <div class="card-body">
                       <div class="row">
                           <h3>Summary</h3>
                           <div class="form-group">
                               <label for="start">Filter date:</label>
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
                                    <h4 class="">Budget</h4>
                                </div>
                            </div>
                            <div class="col-7 col-md-8" id="budgetcontent">
                                <div class="numbers">
                                    <p class="card-category" id="budgetlabel">Budget</p>
                                    <p class="card-title">P 1,346<p>
                                </div>
                                <div class="numbers">
                                    <p class="card-category" id="budgetlabel">Total Expenses</p>
                                    <p class="card-title">P 1,346<p>
                                </div>
                                <div class="numbers">
                                    <p class="card-category" id="budgetlabel">Balance</p>
                                    <p class="card-title">P 1,346<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
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
                                    <h4 class="">Guest List</h4>
                                </div>
                            </div>
                            <div class="col-7 col-md-8" id="guestcard">
                                <div class="numbers">
                                    <p class="card-category" id="label">Attending</p>
                                    <p class="card-title" id="num">50<p>
                                </div>
                                <div class="numbers">
                                    <p class="card-category" id="label">Plus Ones</p>
                                    <p class="card-title" id="num">5<p>
                                </div>
                                <div class="numbers">
                                    <p class="card-category" id="label">Total Guests</p>
                                    <p class="card-title" id="num">55<p>
                                </div>
                                <hr>
                                <div class="label1">
                                    <div class="numbers">
                                        <p class="card-category" id="label">Not Attending</p>
                                        <p class="card-title" id="num">10<p>
                                    </div>
                                    <div class="numbers">
                                        <p class="card-category" id="label">Did Not Respond</p>
                                        <p class="card-title" id="num1">5<p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar-o"></i> Response Due Date
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-6" id="bookingreqcard">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-title">Booking Requests</h5>
                        <p class="card-category">For the Month</p>
                    </div>
                    <div class="table-responsive" id="bookingtable">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>
                                Vendor
                            </th>
                            <th>
                                Date/Time
                            </th>
                            <th>
                                Status
                            </th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    Vendor Name
                                </td>
                                <td>
                                    June 19 2019
                                </td>
                                <td>
                                    Accepted
                                </td>
                                <td class="text-right">
                                    <button class="btn button_1 listbtn1">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Vendor Name
                                </td>
                                <td>
                                    June 19 2019
                                </td>
                                <td>
                                    Accepted
                                </td>
                                <td class="text-right">
                                    <button class="btn button_1 listbtn1">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Vendor Name
                                </td>
                                <td>
                                    June 19 2019
                                </td>
                                <td>
                                    Accepted
                                </td>
                                <td class="text-right">
                                    <button class="btn button_1 listbtn1">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Vendor Name
                                </td>
                                <td>
                                    June 19 2019
                                </td>
                                <td>
                                    Accepted
                                </td>
                                <td class="text-right">
                                    <button class="btn button_1 listbtn1">View</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card ">
                    <div class="card-header">
                        <h5 class="card-title">Feedback</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <table class="table">
                                <thead class="text-primary">
                                <th>
                                    Vendor
                                </th>
                                <th>
                                    Ave Rating
                                </th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        Vendor Name
                                    </td>
                                    <td>
                                        (Star) 4.5
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Vendor Name
                                    </td>
                                    <td>
                                        (Star) 4.5
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Vendor Name
                                    </td>
                                    <td>
                                        (Star) 4.5
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Vendor Name
                                    </td>
                                    <td>
                                        (Star) 4.5
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Vendor Name
                                    </td>
                                    <td>
                                        (Star) 4.5
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Vendor Name
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
    </div>
@endsection

