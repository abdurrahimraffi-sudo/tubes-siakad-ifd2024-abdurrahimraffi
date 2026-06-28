@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #2563EB 0%, #1E40AF 100%); padding: 1rem;">
    <div class="container" style="max-width: 900px;">
        <div class="row align-items-center shadow-lg" style="border-radius: 20px; overflow: hidden; background: white;">
            <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center text-white p-5" style="background: linear-gradient(135deg, #2563EB 0%, #1E40AF 100%); min-height: 500px;">
                <i class="fas fa-graduation-cap mb-4" style="font-size: 4rem;"></i>
                <h2 class="fw-bold text-center mb-3">SIAKAD</h2>
                <p class="text-center opacity-75 mb-0">Sistem Informasi Akademik<br>Kelola data akademik dengan mudah dan modern</p>
                <div class="mt-4 d-flex gap-3 opacity-75">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <i class="fas fa-user-graduate"></i>
                    <i class="fas fa-book"></i>
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            <div class="col-md-6 p-5">
                <div class="text-center mb-4 d-md-none">
                    <i class="fas fa-graduation-cap text-primary mb-2" style="font-size: 3rem;"></i>
                    <h3 class="fw-bold text-primary">SIAKAD</h3>
                </div>
                <h4 class="fw-bold mb-1">Selamat Datang</h4>
                <p class="text-muted mb-4">Silakan login untuk melanjutkan</p>

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Email atau password salah.
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-envelope text-muted"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required autofocus>
                        </div>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-lock text-muted"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fas fa-eye"></i></button>
                        </div>
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label text-muted" for="remember">Ingat saya</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold" style="border-radius: 12px;">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </button>
                </form>

                <div class="mt-4 p-3 bg-light" style="border-radius: 12px;">
                    <p class="mb-1 fw-semibold small text-muted">Akun Demo:</p>
                    <p class="mb-1 small"><strong>Admin:</strong> admin@gmail.com / password</p>
                    <p class="mb-0 small"><strong>Mahasiswa:</strong> mahasiswa@gmail.com / password</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('togglePassword').addEventListener('click', function() {
    const pwd = document.getElementById('password');
    const icon = this.querySelector('i');
    if (pwd.type === 'password') {
        pwd.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        pwd.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
});
</script>
@endsection
