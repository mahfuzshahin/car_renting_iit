@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Booking List') }}</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Model</th>
                                <th>License Number</th>
                                <th>Brand</th>
                                <th>Color</th>
                                <th>Driver</th>
                                <th>Seat Capacity</th>
                                <th>Booking Date</th>
                                <th>Booked By</th>
                                <th>Status</th>
                                @if(Auth::user()->role_id == 1)
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $value)
                            <tr>
                                <td>{{$value->car->model}}</td>
                                <td>{{$value->car->license_number}}</td>
                                <td>{{$value->car->brand}}</td>
                                <td>{{$value->car->color}}</td>
                                <td>{{$value->car->driver}}</td>
                                <td>{{$value->car->seat_capacity}}</td>
                                <td>{{$value->start_date}}</td>
                                <td>{{$value->user->name}}</td>
                                <td>{{$value->booking_status}}</td>
                                @if(Auth::user()->role_id == 1)
                                <td>
                                    @if($value->booking_status == 'booked')
                                    <form action="{{route('booking.confirm', $value->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">Confirm</button>
                                    </form>
                                    @endif
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footerScript')
@if(Session::has('success'))
<script type="text/javascript">
$(function() {
    toastr.success("{{ Session::get('success') }}");
})
</script>
@endif
@if(Session::has('fail'))
<script type="text/javascript">
$(function() {
    toastr.error("{{ Session::get('fail') }}");
})
</script>
@endif
@stop