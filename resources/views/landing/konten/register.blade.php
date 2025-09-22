<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Okacake - Registrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fff 0%, #ffb6d5 100%);
            min-height: 100vh;
        }
        .form-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.08);
            padding: 2rem;
            max-width: 900px;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="form-card">
        <h4 class="mb-4 fw-bold">Registrasi Akun Pengguna</h4>
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary mb-3">kembali</a>

        <form method="POST" action="{{ route('auth.register') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama Pengguna</label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" 
                    placeholder="Masukkan Nama....." required autofocus 
                    value="{{ old('nama') }}">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" 
                    placeholder="Masukkan Username....." required 
                    value="{{ old('username') }}">
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="alamat" class="form-label">Alamat Rumah</label>
                <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                    placeholder="Masukkan Alamat....." required 
                    value="{{ old('alamat') }}">
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="no_hp" class="form-label">Nomor Handphone</label>
                <input type="text" name="no_hp" id="no_hp" 
                    class="form-control @error('no_hp') is-invalid @enderror" 
                    placeholder="Masukkan Nomor HP....." required 
                    value="{{ old('no_hp') }}"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="15">
                @error('no_hp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                    placeholder="Masukkan Email....." required 
                    value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="Daftar sebagai" class="form-label">Daftar sebagai</label>
                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                    <option selected disabled> -- Pilih Peran --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Pelanggan</option>
                    <option value="kurir" {{ old('role') == 'kurir' ? 'selected' : '' }}>Kurir</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    placeholder="Masukkan Password....." required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                    class="form-control @error('password_confirmation') is-invalid @enderror" 
                    placeholder="Ulangi Password....." required>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-success me-2">Daftar</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </form>
        <br>
        <span>Sudah punya akun? <a href="{{ route('auth.login') }}">Silahkan login!</a></span>
    </div>
</div>
@include('sweetalert::alert')
</body>
</html>
