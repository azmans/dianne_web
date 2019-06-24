@extends('layouts.admindash')

@section('title', 'Soon-to-weds | DIANNE')

@section('content')
    <div class="container" style="margin-top: 5%">
        <div class="row col-lg-offset-3">
            <div class="col-lg-12">
                <div class="card" style="padding: 5%;">
                    <h3>Soon-to-weds</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Status</th>
                                <th>Bride</th>
                                <th>Groom</th>
                                <th>Email</th>
                                <th>DOB</th>
                                <th>Wedding Date</th>
                                <th>Registered At</th>
                            </tr>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td><img class="img-responsive" height="50" width="60" src="/storage/images/{{ $user->profile_picture }}"></td>
                                    <td>
                                        @if(is_null($user->blacklisted_at))
                                            Active
                                        @else
                                            Blacklisted
                                        @endif
                                    </td>
                                    <td>{{ $user->bride_first_name }} {{ $user->bride_last_name }}</td>
                                    <td>{{ $user->groom_first_name }} {{ $user->groom_last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->dob)->format('d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->wedding_date)->format('d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-y h:m A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No users found.</td>
                                </tr>
                            @endforelse
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection