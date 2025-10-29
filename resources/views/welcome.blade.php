<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <title>Home Page</title>
</head>
<body>
    @auth
        <div class="navbar">
            <div class="left">
                <a href="/about">About</a>
                <a href="/contact">Contact</a>
                <a href="/add-car">Add Car</a>
            </div>
            <div class="right">
                <p style="color: aliceblue";>Merhaba {{ Auth::user()->name }}!</p>
                <a href="/logout">Logout</a>
            </div>
        </div>
    @endauth
    @guest
        <div class="navbar">
            <div class="left">
                <a href="/about">About</a>
                <a href="/contact">Contact</a>
            </div>
            <div class="right">
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            </div>
        </div>
    @endguest

    <div class="container" style="display: flex;">
        <div class="filter">
            <form action="{{ route('cars.filter') }}" method="GET">

                <div class="filter-group">

                    <label for="brand" style="display: none;">Marka</label>
                    <select class="form-control" id="brand" name="brand">
                        <option value="">Marka Seçiniz...</option>

                        @foreach ($allBrands as $brand)
                            <option value="{{ $brand }}">{{ $brand }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group" id="model-group" style="display: none;">
                    <label for="model" style="display: none;">Model</label>
                    <select class="form-control" id="model" name="model" disabled>
                        <option value="">Önce Marka Seçiniz</option>
                    </select>
                </div>

                <div class="filter-group" id="gear_type-group" style="display: none;">
                    <label for="gear_type" style="display: none;">Vites Tipi</label>
                    <select class="form-control" name="gear_type" id="gear_type">
                        <option value="">Vites Tipi Seçiniz...</option>
                        <option value="Manual">Manuel</option>
                        <option value="Automatic">Otomatik</option>
                    </select>
                </div>

                <div class="filter-group" id="fuel_type-group" style="display: none;">
                    <label for="fuel_type" style="display: none;">Yakıt Tipi</label>
                    <select class="form-control" name="fuel_type" id="fuel_type">
                        <option value="">Yakıt Tipi Seçiniz...</option>
                        <option value="Gasoline">Benzin</option>
                        <option value="Diesel">Dizel</option>
                        <option value="Electric">Elektrik</option>
                        <option value="Hybrid">Hibrit</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Ara</button>
            </form>
        </div>
        <div class="slider" id="slider">
            <div class="slides" id="slides">
                {{-- *** DÜZELTME: Her bir araba bir 'slide' div'i içinde olmalıdır *** --}}
                @foreach ($data as $car)
                    <div class="slide">
                        <h2>{{ $car->brand }} - {{ $car->model }}</h2>
                        @if ($car->image->isNotEmpty())
                            @php
                                // Koleksiyonun ilk elemanını al (hasMany ilişkisinde ilk resim)
                                // Yani bir arabanın birçok resmi olabilir ilk resim sergilensin
                                $firstImage = $car->image->first();
                            @endphp
                            <img src="{{ asset('storage/' . $firstImage->img_url) }}" alt="{{ $car->brand }} İlk Resmi">
                        @endif
                    </div>
                @endforeach
            </div>

            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>
</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('script/filter.js') }}"></script>
    <script>
        $(document).ready(function() {

            const $modelGroup = $('#model-group');
            const $modelSelect = $('#model');
            const $gearTypeGroup = $('#gear_type-group');
            const $gearTypeSelect = $('#gear_type');
            const $fuelTypeGroup = $('#fuel_type-group');
            const $fuelTypeSelect = $('#fuel_type');

            // 1. Marka (Brand) Değişikliği: Modelleri Yükle
            $('#brand').on('change', function() {
                var brandName = $(this).val();

                // Marka değiştiğinde diğer alanları sıfırla ve gizle
                $modelSelect.html('<option value="">Önce Marka Seçiniz</option>').prop('disabled', true);
                $modelGroup.slideUp(200);
                $gearTypeGroup.slideUp(200);
                $fuelTypeGroup.slideUp(200);

                if (brandName) {
                    // Modelleri yüklemeden önce Model grubunu göster
                    $modelGroup.slideDown(300);
                    $modelSelect.html('<option value="">Modeller Yükleniyor...</option>');

                    // AJAX İsteği: Seçilen markaya ait modelleri getir
                    $.ajax({
                        url: '{{ route('getModelsByBrand') }}',
                        type: 'GET',
                        data: { brand: brandName },
                        dataType: 'json',
                        success: function(models) {
                            $modelSelect.html('<option value="">Tüm Modeller</option>');
                            $.each(models, function(key, model) {
                                $modelSelect.append('<option value="' + model + '">' + model + '</option>');
                            });
                            $modelSelect.prop('disabled', false);
                        }
                    });
                }
            });

            // 2. Vites Tipi Değişikliği
            $modelSelect.on('change', function() {
                var modelName=$(this).val();
                var brandName = $('#brand').val();

                $gearTypeGroup.slideDown(300);

                if(modelName){
                    $.ajax({
                        url: '{{ route('getGearTypeByModel') }}',
                        type: 'GET',
                        data: { model: modelName, brand: brandName },
                        dataType: 'json',
                        success: function(gearTypes) {
                            $gearTypeSelect.html('<option value="">Vites Tipi Seçiniz...</option>');
                            $.each(gearTypes, function(key, gearType) {
                                $gearTypeSelect.append('<option value="' + gearType + '">' + gearType + '</option>');
                            });
                        }
                    });
                }else {
                        $gearTypeSelect.html('<option value="">Bu model için vites tipi bulunamadı</option>').prop('disabled', true);
                }
            });

            // 3. Yakıt Tipi Değişikliği
            $gearTypeSelect.on('change', function() {
                var gearType=$(this).val();
                var brandName = $('#brand').val();
                var modelName = $('#model').val();

                $fuelTypeGroup.slideDown(300);

                if(gearType){
                    $.ajax({
                        url:'{{route('getFuelTypeByGearType')}}',
                        type:'GET',
                        data:{ gearType:gearType, brand:brandName, model:modelName},
                        dataType:"json",
                        success:function(fuelTypes){
                            $fuelTypeSelect.html('<option value=">--Select a Fuel Type--</option>');
                            $.each(fuelTypes, function(key, fuelType) {
                                $fuelTypeSelect.append('<option value="' + fuelType + '">' + fuelType + '</option>');
                            });
                        }
                    })
                }else{
                    $fuelTypeSelect.html('<option value="">Bu vites tipi için yakıt tipi bulunamadı</option>').prop('disabled', true);
                }
            });

        });
    </script>
</body>
</html>
