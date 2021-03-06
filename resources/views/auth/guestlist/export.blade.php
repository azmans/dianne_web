<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Export Guestlist</title>
    <style type ="text/css" >
        .footer{
            position: fixed;
            text-align: center;
            bottom: 0px;
            width: 100%;
        }
    </style>
</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <img src="https://i.ibb.co/zQ18yBL/diannelogo.png" alt="diannelogo" width="70" height="70" border="0">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Email</th>
                    <th>Choice of Meal</th>
                    <th>Plus One</th>
                    <th>Allergies</th>
                </tr>
                </thead>
                <tbody>
                @if(is_null($data))
                    <td></td>
                @else
                    @foreach($data as $guest)
                    <tr>
                        <td>{{ $guest->first_name }} {{ $guest->last_name }}</td>
                        <td>{{ $guest->status }}</td>
                        <td>{{ $guest->email }}</td>
                        <td>{{ $guest->meal_type }}</td>
                        <td>
                            @if($guest->plus_one == 1)
                                Yes
                            @else
                                No
                            @endif
                        </td>
                        <td>
                            @if(is_null($guest->allergy))
                                None
                            @else
                                {{ decrypt($guest->allergy) }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer">
        <p><small>Printed at: {{ date('Y-m-d H:i:s') }}</small></p>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>