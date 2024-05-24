@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New car') }}</div>

                <div class="card-body">
                    <form action="{{route('store.car')}}" method="POST">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="model">Model:</label>
                            <input type="model" class="form-control" id="model" placeholder="Enter model" name="model">
                        </div>
                        <div class="mb-3">
                            <label for="license_number">License number:</label>
                            <input type="text" class="form-control" id="license_number"
                                placeholder="Enter License number" name="license_number">
                        </div>
                        <div class="mb-3">
                            <label for="brand">Brand:</label>
                            <input type="text" class="form-control" id="brand" placeholder="Enter brand" name="brand">
                        </div>
                        <div class="mb-3">
                            <label for="color">Color:</label>
                            <input type="text" class="form-control" id="color" placeholder="Enter Color" name="color">
                        </div>
                        <div class="mb-3">
                            <label for="driver">Driver:</label>
                            <input type="text" class="form-control" id="driver" placeholder="Enter Driver"
                                name="driver">
                        </div>
                        <div class="mb-3">
                            <label for="seat_capacity">Seat Capacity:</label>
                            <input type="number" class="form-control" id="seat_capacity" min="1"
                                placeholder="Enter Seat capacity" name="seat_capacity">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" min="1" name="status">
                                <option value="available">Available</option>
                                <option value="rented">Rented</option>
                            </select>
                        </div> -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection