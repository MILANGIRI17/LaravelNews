<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link href="{{url('backend-ui/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('backend-ui/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Password Reset</h1> 
                @include('backend.layouts.message')
                <hr>
                <form action="{{route('password-reset')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email: <a style="color: red;">{{$errors->first('email')}}</a></label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <button class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="{{url('backend-ui/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{url('backend-ui/custom/custom.js')}}"></script>
</html>