{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body {
    background-image: url('{{ asset('assets/img/desa-bg.jpeg') }}');
    background-size: cover;          /* Nutupin seluruh layar */
    background-repeat: no-repeat;    /* Gak diulang */
    background-position: center;     /* Di tengah */
    min-height: 100vh;               /* Minimal setinggi layar */
    margin: 0;                       /* Hilangin margin bawaan */
}


.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 520px;
    width: 400px;
    background-color: rgba(123, 123, 123, 0.46);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 40px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 26px;
    font-weight: bold;
    line-height: 42px;
    text-align: center;
    margin-top: 15px;
}
form h5{
    font-size: 18px;
    font-weight: 500;
    line-height: 24px;
    /* text-align: center; */
}

label{
    display: block;
    margin-top: 13px;
    font-size: 14px;
    font-weight: 500;
}
a {
    text-decoration: none;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 10px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
    border: 2px solid rgb(105, 105, 105)(154, 154, 154);
}
input:hover {
    border: 2px solid rgb(207, 207, 207);
}
button{
    margin-top: 30px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 10px 0;
    font-size: 18px;
    font-weight: 900;
    border-radius: 10px;
    cursor: pointer;
}
button:hover {
    background: linear-gradient(90deg,rgba(23, 15, 186, 1) 0%, rgba(37, 36, 205, 1) 42%, rgba(40, 40, 209, 1) 50%, rgba(0, 212, 255, 1) 100%);
    color: white;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}
.form-check-label {
    display: block;
    position: relative;
}
.form-check-input {
    position: absolute;
}
.logo {
    width: 65px
}
.shape {
    transition: all 0.4s ease-in-out;
}
.btn-link:hover{
    color: #1f1e1e;
    text-decoration: underline;
    text-shadow: 0 0 5px #b6b6b6, 0 0 10px #939393, 0 0 20px #a2a2a2;
}
.shape:hover {
    transform: scale(1.2) rotate(10deg);
    box-shadow: 0 0 25px rgba(255, 255, 255, 0.5);
    cursor: pointer;
}
::placeholder{
    color: #f3f3f3;
}

#alert-message {
    border-radius: 8px;
    font-weight: 600;
    font-size: 16px;
    color: #800101;
    text-align: center;
  }

  
</style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div style="display:flex; justify-content: center; gap: 10px; margin-bottom: 25px">
            <img class="logo" src="{{ asset('assets/img/logo_pemkab_bogor.jpg') }}" alt="logo">
            
            <h5 style="margin: 0;">Sistem Laporan Kegiatan Dan Proyek Desa Bojong Gede</h5>
        </div>
        @if (session()->has('success') || session()->has('primary') || session()->has('danger') || session()->has('error'))
        <div class="alert alert-{{ session('success') ? 'success' : (session('primary') ? 'primary' : (session('danger') ? 'danger' : 'danger')) }}" role="alert" id="alert-message">
            {{ session('success') ?? session('primary') ?? session('danger') ?? session('error') }}
        </div>
        @endif   
        
        {{-- <h3>Login</h3> --}}

        <hr>
        <div>
            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
            <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">
        </div>

        <div>
            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
        </div>

        <div class="form-check" style="display: flex; align-items: center; margin-top: 10px;">
            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                style="width: 16px; height: 14px; margin-right: 8px;" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember" style="margin: 0; font-size: 14px; padding-left: 20px; padding-top: 8px">
                {{ __('Remember Me') }}
            </label>
        </div>
        <div class="login">
            <button type="submit" class="btn btn-primary fw-bold">
                {{ __('Login') }}
            </button>
        
            @if (Route::has('password.username.form'))
            <div class="text-center" style="text-align: center; margin-top: 18px;">
                <a class="btn btn-link" href="{{ route('password.username.form') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
        @endif
        
        </div>
        
    </form>
</body>
<script>
    const form = document.querySelector('form');
    const shapes = document.querySelectorAll('.shape');

    form.addEventListener('mouseenter', () => {
        // Mengubah bentuk dan warna gradien
        shapes[0].style.transform = 'scale(1.2)';
        shapes[0].style.background = 'linear-gradient(to right, #ff512f, #f09819)';
        shapes[0].style.boxShadow = '0 0 25px rgba(255, 255, 255, 0.5)';

        shapes[1].style.transform = 'scale(1.2)';
        shapes[1].style.background = 'linear-gradient(#1845ad, #23a2f6)';
        shapes[1].style.boxShadow = '0 0 25px rgba(255, 255, 255, 0.5)';
    });

    form.addEventListener('mouseleave', () => {
        // Kembalikan ke keadaan awal
        shapes[0].style.transform = 'scale(1)';
        shapes[0].style.background = 'linear-gradient(#1845ad, #23a2f6)';
        shapes[0].style.boxShadow = 'none';

        shapes[1].style.transform = 'scale(1)';
        shapes[1].style.background = 'linear-gradient(to right, #ff512f, #f09819)';
        shapes[1].style.boxShadow = 'none';
    });
    setTimeout(() => {
        const alert = document.getElementById('alert-message');
        if (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500); // hapus dari DOM setelah hilang
        }
    }, 3000); // 3000ms = 3 detik
</script>

</html>
