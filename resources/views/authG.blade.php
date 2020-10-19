<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{'css/login.css'}}" rel="stylesheet">


</head>
<body>

<section class="login-block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form class="md-float-material form-material blook" action="#" method="POST">
                    <div class="auth-box card">
                        <div class="card-block">

                            <div class="or-container">
                                <div class="line-separator"></div>
                                <div class="or-label"><h2>NGTI</h2></div>
                                <div class="line-separator"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12"> <a class="btn btn-lg btn-google btn-block text-uppercase btn-outline" href="{{url('auth/google')}}"><img src="https://img.icons8.com/color/16/000000/google-logo.png"> Signup Using Google</a> </div>
                            </div> <br>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<script src="/js/app.js"></script>

</body>
</html>