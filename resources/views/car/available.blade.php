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
                        <div class="mb-3 mt-3">
                            <label for="end_date">End Date:</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
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
                    let carsListHtml = '<h2>Available Cars</h2><ul>';
                    availableCars.forEach(function(car) {
                        carsListHtml += '<li>' + car.model +
                            '<button class="book-car-btn" data-car-id="' + car.id +
                            '">Book Now</button></li>';
                    });
                    carsListHtml += '</ul>';
                    $('#available-cars').html(carsListHtml);

                    // Bind event handlers to the buttons (if necessary)
                    $('.book-car-btn').on('click', function() {
                        let carId = $(this).data('car-id');
                        console.log(carId);
                        window.location.href = '/book/' + carId;
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