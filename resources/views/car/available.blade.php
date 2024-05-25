@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Search Available car') }}</div>

                <div class="card-body">
                    <form id="availability-form" action="{{route('available-cars')}}" method="get">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="start_date">Start Date:</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <!-- <div class="mb-3 mt-3">
                            <label for="end_date">End Date:</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div> -->
                        <button type="submit" class="btn btn-primary">Check Availability</button>
                    </form>
                    <div id="errors" style="color: red;"></div>
                    <div id="available-cars">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footerScript')
<script>
$(document).ready(function() {
    $('#availability-form').on('submit', function(event) {
        event.preventDefault();
        $('#errors').html('');
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                // $('#available-cars').html(response);
                console.log(response);
                let availableCars = response.data;
                if (availableCars.length > 0) {
                    let carsListHtml =
                        '<h3>Available Car</h3><table class="table"><thead><tr><th>Model</th><th>Driver</th><th>Action</th></tr></thead><tbody>';

                    availableCars.forEach(function(car) {
                        carsListHtml += '<tr><td>' + car.model + '</td>' + '<td>' +
                            car.driver + '</td>' +
                            '<td><button class="btn btn-primary book-car-btn" data-car-id="' +
                            car.id +
                            '">Book Now</button></td></tr>';
                    });
                    let date = $('#availability-form input[name="start_date"]').val();
                    carsListHtml += '</tbody></table>';
                    $('#available-cars').html(carsListHtml);

                    // Bind event handlers to the buttons (if necessary)
                    $('.book-car-btn').on('click', function() {
                        let carId = $(this).data('car-id');
                        console.log(carId);
                        window.location.href = '/book/' + carId + '?date=' +
                            encodeURIComponent(date);;
                    });
                } else {
                    // No available cars
                    $('#available-cars').html(
                        '<p>No cars available for the selected dates.</p>');
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorHtml = '<ul>';
                $.each(errors, function(key, value) {
                    errorHtml += '<li>' + value[0] + '</li>';
                });
                errorHtml += '</ul>';
                $('#errors').html(errorHtml);
            }
        });
    });
});
</script>
@stop