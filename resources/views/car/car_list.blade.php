@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Car List') }}</div>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cars as $value)
                            <tr>
                                <td>{{$value->model}}</td>
                                <td>{{$value->license_number}}</td>
                                <td>{{$value->brand}}</td>
                                <td>{{$value->color}}</td>
                                <td>{{$value->driver}}</td>
                                <td>{{$value->seat_capacity}}</td>
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