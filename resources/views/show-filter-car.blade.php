<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <title>Document</title>
</head>
<body>
    @auth
        <div class="navbar">
            <div class="left">
                <a href="/">Home</a>
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
                <a href="/">Home</a>
                <a href="/about">About</a>
                <a href="/contact">Contact</a>
            </div>
            <div class="right">
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            </div>
        </div>
    @endguest
    <div class="results">
        @if ($filteredData->isEmpty())
            <p>Seçtiğiniz kriterlere uygun araç bulunamadı.</p>
        @else
            @foreach ($filteredData as $car)
                <div class="car-item">
                    <h2>{{ $car->brand }} - {{ $car->model }} ({{ $car->price }} TL)</h2>

                    @if ($car->image->isNotEmpty())
                        @php
                            // İlk resmi alıyoruz
                            $firstImage = $car->image->first();
                        @endphp
                        <img src="{{ asset('storage/' . $firstImage->img_url) }}" alt="{{ $car->brand }} Resmi">
                    @else
                        <p>Resim Yok.</p>
                    @endif

                    <ul>
                        <li>Vites: {{ $car->gear_type }}</li>
                        <li>Yakıt: {{ $car->fuel_type }}</li>
                        {{-- ... (Diğer bilgileri ekleyebilirsiniz) ... --}}
                    </ul>
                </div>
                <hr>
            @endforeach
        @endif
    </div>

</body>
</html>
