<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fff 0%, #ffb6d5 100%);
            min-height: 100vh;
        }
        .login-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.08);
            padding: 2rem;
            max-width: 400px;
            width: 100%;
        }
        .logo {
            width: 150px;
            height: 150px;
            object-fit: contain;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="login-card text-center">
            <img src="{{ asset('landing/images/logo.png') }}" alt="Logo" class="logo mx-auto d-block">
            <h5 class="mb-4">Sistem Informasi Manajemen POS</h5>
            <form method="POST" action="{{ route('auth.login') }}">
                @csrf
                <div class="mb-3 text-start">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required autofocus autocomplete="off" value="{{ old('username') }}">
                </div>
                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required autocomplete="off">
                </div>
                {{-- <div class="mb-3 form-check text-start">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div> --}}
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
@include('sweetalert::alert')
</body>
</html>