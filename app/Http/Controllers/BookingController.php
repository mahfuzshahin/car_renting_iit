<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Booking;
use App\Models\Car;
use Auth;
class BookingController extends Controller
{
    public function available_car(){
        // $available_cars = Car::where('status','available')->get();
        return view('car.available');
    }
    public function show_available_car(Request $request){
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $availableCars = Car::where('status', 'available')
            ->whereNotIn('id', function($query) use ($startDate, $endDate) {
                $query->select('car_id')
                      ->from('bookings')
                      ->where(function($query) use ($startDate, $endDate) {
                          $query->whereBetween('start_date', [$startDate, $endDate])
                                ->orWhereBetween('end_date', [$startDate, $endDate])
                                ->orWhere(function($query) use ($startDate, $endDate) {
                                    $query->where('start_date', '<', $startDate)
                                          ->where('end_date', '>', $endDate);
                                });
                      });
            })->get();
            if($request->ajax()) {
                return response()->json(['data' => $availableCars]);
            }
        // return view('car.show_available_cars', compact('availableCars'));
    }
    public function book($id){
        $book = Car::find($id);
        // dd($book);
        return view('car.booking', compact('book','id'));
    }
    public function book_car(Request $request, $id){
        $booking = Booking::create([
            'user_id' => Auth::user()->id,
            'car_id' => 1,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'booking_status' => 'booked',
        ]);
        return response()->json(['message' => 'Booking successful', 'booking' => $booking]);
    }
}