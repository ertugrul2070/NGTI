@include('layout')
<head>
    <link href="{{asset('css/planner.css')}}" rel="stylesheet">
</head>
<main>
    <div>

        <main class="page-content">
            <div class="card">
                <div class="content">
                    <h2 class="title">Plan solo</h2>
                    <p class="copy">Secure a place for your self in the office</p>
                    <a href="{{url('/planner/solo')}}" ><button class="btn">Plan</button></a>
                </div>
            </div>
            <div class="card">
                <div class="content">
                    <h2 class="title">Plan with Group</h2>
                    <p class="copy">Secure a couple places in the office for you and your group</p>
                    <a href="{{url('/planner/group')}}" ><button class="btn">Plan</button></a>
                </div>
            </div>
        </main>
    </div>
</main>