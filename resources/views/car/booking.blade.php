@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Booking') }}</div>

                <div class="card-body">
                    <table>
                        <tr>
                            <th>Model:</th>
                            <td>{{$book->model}}</td>
                        </tr>
                        <tr>
                            <th>Brand:</th>
                            <td>{{$book->brand}}</td>
                        </tr>
                        <tr>
                            <th>Color:</th>
                            <td>{{$book->color}}</td>
                        </tr>
                        <tr>
                            <th>Driver:</th>
                            <td>{{$book->driver}}</td>
                        </tr>
                        <tr>
                            <th>Seat Capacity:</th>
                            <td>{{$book->seat_capacity}}</td>
                        </tr>
                    </table>
                    <form action="{{route('book.car', $id)}}" method="POST">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="start_date">Start Date:</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                value="{{ old('start_date', $startDate) }}">
                        </div>

                        <button type="submit" class="btn btn-primary" id="book-car-btn">Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footerScript')