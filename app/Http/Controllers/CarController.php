<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use App\Models\Images;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class CarController extends Controller
{
    
    public function showAdd()
    {
        return view('add-car');
    }


    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'gear_type' => 'required|string',
            'fuel_type' => 'required|string',
            'mileage' => 'required|numeric',
            'year' => 'required|digits:4|integer',
            'color' => 'required|string|max:50',
            'price' => 'required|numeric',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);


        $car = Cars::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'gear_type' => $request->gear_type,
            'fuel_type' => $request->fuel_type,
            'mileage' => $request->mileage,
            'year' => $request->year,
            'color' => $request->color,
            'price' => $request->price,
            'user_id' => Auth::id(),
        ]);


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public'); // storage/app/public/cars
                Images::create([
                    'img_url' => $path,
                    'car_id' => $car->id,
                ]);
            }
        }

        User::where('id',Auth::id())->update(['role_id' => 3]);

        return redirect("/")->with('success', 'Araç başarıyla eklendi.');
    }

}
