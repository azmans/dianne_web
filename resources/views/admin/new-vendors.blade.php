@extends('layouts.home')

@section('title', 'Vendor Approvals | DIANNE')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12"><br><br><br><br>
                <h3>Newly Registered Vendors to Approve</h3>
                <div class="table-responsive">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <table class="table table-responsive">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Vendor Type</th>
                            <th>TIN</th>
                            <th>SEC/DTI Number</th>
                            <th>Mayor's Permit</th>
                            <th>Registered at</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @forelse ($vendors as $vendor)
                            <tr>
                                <td>{{ $vendor->first_name }} {{ $vendor->last_name }}</td>
                                <td>{{ $vendor->email }}</td>
                                <td>{{ $vendor->vendor_type }}</td>
                                <td>{{ $vendor->tin }}</td>
                                <td>{{ $vendor->sec_dti_number }}</td>
                                <td>{{ $vendor->mayors_permit }}</td>
                                <td>{{ \Carbon\Carbon::parse($vendor->created_at)->format('d F Y h:m:s A') }}</td>
                                <td><a href="{{ route('admin.vendors.approve', $vendor->id) }}"
                                       class="btn btn-primary btn-sm">Approve</a></td>
                                <td><a href="{{ route('admin.vendors.reject', $vendor->id) }}"
                                       class="btn btn-danger btn-sm">Reject</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No vendors found.</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection