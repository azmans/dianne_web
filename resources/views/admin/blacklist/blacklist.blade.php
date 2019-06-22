@extends('layouts.admindash')

@section('title', 'Blacklisted Users | DIANNE')

@section('content')
    <div class="container" style="margin-top: 5%">
        <div class="row col-lg-offset-3">
            <div class="col-lg-12">
                <div class="card" style="padding: 5%;">
                    <h3>Blacklist</h3>
                    <div class="table-responsive">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                              {{ session('message') }}
                          </div>
                       @endif

                       <table class="table">
                         <tr>
                             <th>User ID</th>
                             <th>User Type</th>
                             <th>Name</th>
                             <th>Reason for Blacklist</th>
                             <th>Blacklisted at</th>
                             <th></th>
                        </tr>
                        @forelse ($blacklists as $blacklist)
                            <tr>
                                <td>
                                    @if($blacklist->soon_to_wed_id)
                                        {{ $blacklist->soon_to_wed_id }}
                                    @elseif($blacklist->vendor_id)
                                        {{ $blacklist->vendor_id }}
                                    @endif
                                </td>
                                <td>
                                    @if($blacklist->soon_to_wed_id)
                                        Soon-to-wed
                                    @elseif($blacklist->vendor_id)
                                        Vendor
                                    @endif
                                </td>
                                <td>
                                    @if($blacklist->soon_to_wed_id)
                                        {{ $blacklist->bride_first_name }} & {{ $blacklist->groom_first_name }}
                                    @elseif($blacklist->vendor_id)
                                        {{ $blacklist->first_name }} {{ $blacklist->last_name }}
                                    @endif
                                </td>
                                <td>{{ $blacklist->reason }}</td>
                                <td>
                                    @if($blacklist->soon_to_wed_id)
                                        {{ $blacklist->created_at }}
                                    @elseif($blacklist->vendor_id)
                                        {{ $blacklist->blacklisted_at }}
                                    @endif
                                </td>
                                <td><a href="#" class="btn btn-primary btn-sm">Revoke</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No blacklisted users found.</td>
                            </tr>
                        @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection