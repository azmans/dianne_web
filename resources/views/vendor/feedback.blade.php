@extends('layouts.vendordashboard')

@section('title', 'Feedback | DIANNE')

@section('content')
    <div class="container" style="margin-top: 10%">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Feedback</h3>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Submitted by</th>
                            <th>Value</th>
                            <th>Promptness</th>
                            <th>Quality</th>
                            <th>Professionalism</th>
                            <th>Overall</th>
                            <th>Submitted at</th>
                        </tr>
                        @forelse ($feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->bride_first_name }} {{ $feedback->bride_last_name }} &
                                    {{ $feedback->groom_first_name }} {{ $feedback->groom_last_name }}</td>
                                <td>{{ $feedback->value }}</td>
                                <td>{{ $feedback->promptness }}</td>
                                <td>{{ $feedback->quality }}</td>
                                <td>{{ $feedback->professionalism }}</td>
                                <td>{{ $feedback->overall }}</td>
                                <td>{{ \Carbon\Carbon::parse($feedback->created_at)->format('d F Y h:m A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No feedback by clients submitted.</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection