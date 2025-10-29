<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <title>Add Car Page</title>
</head>
<body>
    @auth
        <div class="navbar">
            <div class="left">
                <a href="/about">About</a>
                <a href="/contact">Contact</a>
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
            </div>
        </div>
    @endguest

    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="brand" class="form-label">Marka</label>
            <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand') }}" required>
        </div>

        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" class="form-control" id="model" name="model" value="{{ old('model') }}" required>
        </div>

        <div class="mb-3">
            <label for="gear_type" class="form-label">Vites Tipi</label>
            <select class="form-select" name="gear_type" id="gear_type" required>
                <option value="">Seçiniz</option>
                <option value="Manual">Manuel</option>
                <option value="Automatic">Otomatik</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="fuel_type" class="form-label">Yakıt Tipi</label>
            <select class="form-select" name="fuel_type" id="fuel_type" required>
                <option value="">Seçiniz</option>
                <option value="Gasoline">Benzin</option>
                <option value="Diesel">Dizel</option>
                <option value="Electric">Elektrik</option>
                <option value="Hybrid">Hibrit</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="mileage" class="form-label">Kilometre</label>
            <input type="decimal" class="form-control" id="mileage" name="mileage" value="{{ old('mileage') }}" required>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Yıl</label>
            <input type="year" class="form-control" id="year" name="year" value="{{ old('year') }}" required>
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Renk</label>
            <input type="text" class="form-control" id="color" name="color" value="{{ old('color') }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Fiyat</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">Resimler</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Araç Ekle</button>
    </form>

</body>
</html>
