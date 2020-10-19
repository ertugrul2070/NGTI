@include('layout')
<h1 style="color: black; margin-left: 25%">    {{\Carbon\Carbon::now()}} </h1>
<table class="table table-dark" style="width: 50%; margin-left: 25%; margin-top: 5%">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Time</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($resevations as $resevation)
        @if($resevation->reservation_date == \Carbon\Carbon::now()->toDateString())
            <tr>
                <td>{{ $resevation->name }}</td>
                <td>{{ $resevation->start_time }} - {{ $resevation->end_time }}</td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>