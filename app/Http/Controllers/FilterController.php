<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Images;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function showBrands()
    {
        $allBrands = Cars::select('brand')->distinct()->pluck('brand');
        return view('welcome', compact('allBrands'));
    }

    public function getModelsByBrand(Request $request)
    {
        $brand = $request->input('brand');

        $models = Cars::where('brand', $brand)
            ->distinct('model')
            ->pluck('model');

        return response()->json($models);
    }

    public function getGearTypeByModel(Request $request)
    {
        $model = $request->input('model');
        $brand = $request->input('brand');

        $gearTypes = Cars::where('model', $model)->where('brand', $brand)
            ->distinct('gear_type')->pluck('gear_type');

        return response()->json($gearTypes);
    }

    public function getFuelTypeByGearType(Request $request)
    {
        $gearType= $request->input('gearType');
        $model = $request->input('model');
        $brand = $request->input('brand');

        $fuelTypes=Cars::where('model', $model)->where('brand', $brand)
        ->where('gear_type', $gearType)->distinct('fuel_type')->pluck('fuel_type');

        return response()->json($fuelTypes);
    }

    public function filterCars(Request $request)
    {
        // 1. Tüm markaları tekrar al (Filtre sayfasında da filtreleme kutusu gösterilebilir)
        $allBrands = Cars::select('brand')->distinct()->pluck('brand');

        // 2. Temel sorguyu Cars modeliyle başlat
        $query = Cars::with('image');

        // 3. İstekten gelen parametrelere göre sorguya koşul ekle
        if ($request->filled('brand')) {
            $query->where('brand', $request->input('brand'));
        }

        if ($request->filled('model')) {
            $query->where('model', $request->input('model'));
        }

        // Vites ve yakıt tiplerini AJAX ile değil, form gönderimi ile alıyoruz
        if ($request->filled('gear_type')) {
            $query->where('gear_type', $request->input('gear_type'));
        }

        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->input('fuel_type'));
        }

        // 4. Filtrelenmiş verileri çek
        $filteredData = $query->get();

        // 5. Filtrelenmiş verileri yeni görünüme gönder
        // Not: Varsayılan olarak welcome.blade.php'de gösterdiğiniz veriye burada $data yerine $filteredData adını verdik.
        return view('show-filter-car', compact('filteredData', 'allBrands'));
    }

    public function showCars(Request $request)
    {
        $allBrands=Cars::select('brand')->distinct()->pluck('brand'); // Kullanılmadı, hatayı gidersin diye ekledik
        $data = Cars::with('image')->get(); // Cars ve ilişkili image

        return view('welcome', compact('data', 'allBrands'));
    }



}
