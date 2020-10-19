<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('css/layout.css')}}" rel="stylesheet">

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body>

<nav class="menu" tabindex="0">
    <div class="smartphone-menu-trigger"></div>
    <header class="avatar">
        <img src="https://res-5.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_170,w_170,f_auto,b_white,q_auto:eco/v1469463557/nswj9f0e9o268twigaxl.png"/>
        <h2>@if (Auth::guest())
                User not logged in
            @else
                {{ Auth::user()->name }}
            @endif</h2>
    </header>
    <ul>
        <a class="link" href="{{url('/welcome')}}">
            <li tabindex="0" class="icon-dashboard"><span>Dashboard</span></li>
        </a>
        <a class="link" href="{{url('/planner')}}">
            <li tabindex="0" class="icon-customers"><span>Planner</span></li>
        </a>
        <a class="link" href="{{url('#')}}">
            <li tabindex="0" class="icon-users"><span>Agenda</span></li>
        </a>
        <a class="link" href="{{url('/admin')}}">
            <li tabindex="0" class="icon-settings"><span>Admin</span></li>
        </a>
        <a class="link lower" href="{{url('/logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <li tabindex="0" class="icon-log-out lower"><span>LogOut</span></li>
        </a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </ul>
</nav>


<script src="/js/app.js"></script>

</body>
</html>