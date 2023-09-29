<!doctype html>
<html lang="en">
<head>
    <title>{{env('APP_NAME')}}- Partners and E-Ticketing Dashboard </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('admin-asset/css/style.css')}}">
    <style>
        .field-icon {
            float: right;
            margin-left: -25px;
            margin-top: -25px;
            position: relative;
            z-index: 2;
        }

        .container {
            padding-top: 50px;
            margin: auto;
        }
    </style>

</head>
<body>
<section class="ftco-section" style="background: url('{{ asset('/new-assets/img/footerimage.png')}}')">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section" style="color: azure">Partners & e-Ticketing</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-user-o"></span>
                    </div>
                    <h3 class="text-center mb-4">Sign In</h3>
                    <form action="{{route('e-ticket.login')}}" method="POST" class="login-form">
                        @csrf
                        <input type="hidden" name="type" value="admin">
                        <div class="form-group">
                            <input type="text" class="form-control rounded-left @error('email')is-invalid @enderror"
                                   placeholder="Email" name="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password"
                                   class="form-control rounded-left @error('password')is-invalid @enderror"
                                   placeholder="Password" name="password" id="myInput"/>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{asset('admin-asset/js/jquery.min.js')}}"></script>
<script src="{{asset('admin-asset/js/popper.js')}}"></script>
<script src="{{asset('admin-asset/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin-asset/js/main.js')}}"></script>
<script>
    $(".toggle-password").click(function () {

        $(this).toggleClass("fa-eye fa-eye-slash");
// var input = $($(this).attr("toggle"));
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    });
</script>

</body>
</html>


