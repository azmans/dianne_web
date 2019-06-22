@extends('layouts.admindash')

@section('title', 'Vendors | DIANNE')

@section('content')
    <div class="container" style="margin-top: 5%">
        <div class="row col-lg-offset-3">
            <div class="col-lg-12">
                <div class="card" style="padding: 5%;">
                    <h3>Vendors</h3>
                    <div class="table-responsive">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Status</th>
                                <th>Company</th>
                                <th>Vendor Type</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>City</th>
                                <th>Registered At</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @forelse ($vendors as $vendor)
                                <tr>
                                    <td>{{ $vendor->id }}</td>
                                    <td><img class="img-responsive" height="40" width="70" src="/storage/images/{{ $vendor->profile_picture }}"></td>
                                    <td>
                                        @if(is_null($vendor->blacklisted_at))
                                            Active
                                        @else
                                            Blacklisted
                                        @endif
                                    </td>
                                    <td>{{ $vendor->company_name }}</td>
                                    <td>{{ $vendor->vendor_type }}</td>
                                    <td>{{ $vendor->first_name }} {{ $vendor->last_name }}</td>
                                    <td>{{ $vendor->mobile }}</td>
                                    <td>{{ $vendor->email }}</td>
                                    <td>{{ $vendor->city }}</td>
                                    <td>{{ \Carbon\Carbon::parse($vendor->created_at)->format('d-m-y h:m A') }}</td>
                                    <td><a class="btn btn-custom btn-sm" href="#" data-toggle="modal" data-target="#vendor_details-{{ $vendor->id }}">Details</a></td>
                                    <td><a class="btn btn-custom btn-sm" href="/admin/view/vendor/{{ $vendor->id }}">View Profile</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No users found.</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if(!$vendors->isEmpty())
        @foreach($vendors as $vendor)
        <div class="modal fade" id="vendor_details-{{ $vendor->id }}" tabindex="-1" role="dialog" aria-labelledby="details" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="details">Client Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>Business Credentials</h4>
                            <p><b>TIN (Tax Identification Number):</b> {{ $vendor->tin }}</p>
                            <p><b>SEC Number or DTI Business Name:</b> {{ $vendor->sec_dti_number }}</p>
                            <p><b>Mayor's Permit:</b> {{ $vendor->mayors_permit  }}</p>
                            <br>
                            <p><b>Price Range: </b>{{ $vendor->price_range }}</p>
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