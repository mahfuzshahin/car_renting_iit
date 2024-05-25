<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Auth;
class CarController extends Controller
{
    //
    public function new_car(){
        if(Auth::user()->role_id == 1){
            return view('car.new_car');
        }else{
            redirect()->route('home');
        }
        
    }
    public function store_car(Request $request){
        $data_insert = Car::create([
            'user_id' => Auth::user()->id,
            'model' => $request->model,
            'license_number' => $request->license_number,
            'brand' => $request->brand,
            'color' => $request->color,
            'driver' => $request->driver,
            'seat_capacity' => $request->seat_capacity,
            'status' => 'available',
        ]);
        return redirect()->route('new.car')->with('success','Car added successfully');
    }

    public function car_list(){
        if(Auth::user()->role_id == 1){
            $cars = car::all();
            return view('car.car_list',compact('cars'));
        }else{
            redirect()->route('home');
        }
    }
}