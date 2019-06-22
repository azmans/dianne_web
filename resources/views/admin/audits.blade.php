@extends('layouts.admindash')

@section('title', 'User Audits | DIANNE')

@section('content')
    <div class="container" style="margin-top: 5%">
        <div class="card card-nav-tabs card-plain">
            <div class="card-header card-header-danger">
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#data_changes" data-toggle="tab">Data Changes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#login" data-toggle="tab">Login Activity</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body" style="margin-left: 1%">
                <div class="tab-content text-center">
                    <div class="tab-pane active" id="data_changes">
                        <div class="card" style="padding: 5%;">
                            <div class="table-responsive">
                                @if (session('message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                    <table class="table">
                                        <tr>
                                            <th>ID</th>
                                            <th>User ID</th>
                                            <th>User Type</th>
                                            <th>Subject</th>
                                            <th>Description</th>
                                            <th>Timestamp</th>
                                        </tr>
                                        @forelse($audits as $audit)
                                            <tr>
                                                <td>{{ $audit->id }}</td>
                                                <td>
                                                    @if(is_null($audit->soon_to_wed_id) && is_null($audit->vendor_id))
                                                        {{ $audit->admin_id }}
                                                    @elseif(is_null($audit->admin_id) && is_null($audit->vendor_id))
                                                        {{ $audit->soon_to_wed_id }}
                                                    @elseif(is_null($audit->soon_to_wed_id && is_null($audit->admin_id)))
                                                        {{ $audit->vendor_id }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!is_null($audit->soon_to_wed_id))
                                                        Soon-to-wed
                                                    @elseif(!is_null($audit->vendor_id))
                                                        Vendor
                                                    @elseif(!is_null($audit->admin_id))
                                                        Admin
                                                    @endif
                                                </td>
                                                <td>{{ $audit->subject_type }}</td>
                                                <td>{{ $audit->description }}</td>
                                                <td>{{ $audit->created_at }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No audit logs found.</td>
                                            </tr>
                                        @endforelse
                                    </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="login">
                        <div class="card" style="padding: 5%;">
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
                                        <th>User</th>
                                        <th>Last Logged In</th>
                                    </tr>
                                    @foreach($logins as $login)
                                        <tr>
                                            <td>{{ $login->id }}</td>
                                            <td>
                                                @if($login->user_type == 'soon-to-wed')
                                                    Soon-to-wed
                                                @elseif($login->user_type == 'vendor')
                                                    Vendor
                                                @elseif($login->user_type == 'admin')
                                                    Admin
                                                @endif
                                            </td>
                                            <td>
                                                @if($login->user_type == 'soon-to-wed')
                                                    {{ $login->first_name }} & {{ $login->last_name }}
                                                @elseif($login->user_type == 'vendor')
                                                    {{ $login->first_name }} {{ $login->last_name }}
                                                @elseif($login->user_type == 'admin')
                                                    {{ $login->first_name }} {{ $login->last_name }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($login->user_type == 'soon-to-wed')
                                                    {{ $login->last_login_at }}
                                                @elseif($login->user_type == 'vendor')
                                                    {{ $login->last_login_at }}
                                                @elseif($login->user_type == 'admin')
                                                    {{ $login->last_login_at }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if(is_null($logins))
                                        <tr>
                                            <td colspan="4">No audit logs found.</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection