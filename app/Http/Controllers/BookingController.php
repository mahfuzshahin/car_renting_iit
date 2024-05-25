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
            // 'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        $startDate = $request->input('start_date');
        $endDate = $request->input('start_date');

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
    public function book($id, Request $request){
        $book = Car::find($id);
        $startDate = $request->query('date');
        //dd($book);
        return view('car.booking', compact('book','id','startDate'));
    }
    public function book_car(Request $request, $id){
        $booking = Booking::create([
            'user_id' => Auth::user()->id,
            'car_id' => 1,
            'start_date' => $request->start_date,
            'end_date' => $request->start_date,
            'booking_status' => 'booked',
        ]);
        return redirect()->route('home')->with('success','Booking successfull');
    }

    public function booking_list(){
        $bookings = Booking::all();
        return view('car.booking_list', compact('bookings'));
    }
    public function booking_confirm(Request $request, $id){
        $data = Booking::find($id);
        $data->booking_status = 'confirmed';
        $data-> save();
        return redirect()->route('booking.list')->with('success','Booking Confirmed');
    }
}