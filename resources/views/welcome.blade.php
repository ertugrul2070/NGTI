@include('layout')

<link href="{{asset('agenda.css')}}" rel="stylesheet">

<h2 style="color: black; margin-left: 40%">Planning for Today</h2>
<table class="table table-dark" style="width: 50%; margin-left: 25%; margin-top: 5%">
    <thead>
    <tr>
        <th scope="col">date</th>
        <th scope="col">start</th>
        <th scope="col">end</th>
        <th scope="col">type</th>
        <th scope="col">status</th>
        <th scope="col">remark</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        @if($user->reservation_date >= \Carbon\Carbon::now())
        <tr>
            <td>{{ $user->reservation_date }}</td>
            <td>{{ $user->start_time }}</td>
            <td>{{ $user->end_time }}</td>
            <td>{{ $user->reservation_type }}</td>
            @if($user->status == 0)
                <td>Nee</td>
            @elseif($user->status == 1)
                <td>Miss</td>
            @else
                <td>Ja</td>
            @endif
            <td>{{ $user->remark}}</td>
        </tr>
        @endif
    @endforeach
    </tbody>
</table>
