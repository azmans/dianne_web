@extends('layouts.home')

@section('title', 'Blacklist User | DIANNE')

@section('content')
    <div class="container" style="margin-top: 10%">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

            <h3 style="text-align: center">Blacklist this User</h3>
            <hr>
                <form method="POST" id="blacklist_vendor">
                 @csrf

                    <div class="form-group">
                        <label for="reason">Reason for Blacklist</label>
                        <textarea class="form-control" id="reason" name="reason" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <a href="/admin/view/vendor/{{ $vendor->id }}" role="button" class="btn button_1">Back</a>
                        </div>
                        <div class="col-sm">
                            <button type="button" class="button_1" id="submit_request" data-toggle="modal" data-target="#confirm_blacklist">Blacklist</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirm_blacklist" tabindex="-1" role="dialog" aria-labelledby="confirmation" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmation">Blacklist User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to blacklist this user for the following reason?
                    <br>
                    <table class="table">
                        <tr>
                            <td id="reason1"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="submit" class="btn btn-success" href="/admin/vendor/{{ $vendor->id }}/blacklist">Blacklist User</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#submit_request').click(function() {
            $('#reason1').text($('#reason').val());
        });

        $('#submit').click(function(){
            alert('Blacklist User');
            $('#blacklist_vendor').submit();
        });
    </script>
@endsection