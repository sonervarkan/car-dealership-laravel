<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <title>Register Page</title>
</head>
<body>
    <div class="navbar">
        <div class="left">
            <a href="/">Home</a>
        </div>
        <div class="right">
            <a href="/login">Login</a>
        </div>
    </div>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input class="form-control" type="text" name="surname" value="{{ old('surname') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input class="form-control" type="text" name="email" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input class="form-control" type="text" name="phone" value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input class="form-control" type="password" name="password">
        </div>

        <div class="mb-3">
            <label for="role_id" class="form-label">Role</label>
            <select name="role_id" id="role_id" class="form-control">
                <option value="">---Select a Role---</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                        {{ $role->role_type }}
                    </option>
                @endforeach
            </select>
            @error('role_id')
                <div style="color: red; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Register</button>
    </form>
</body>
</html>
