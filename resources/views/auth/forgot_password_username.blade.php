<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Lupa Password - Masukkan Username</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #667eea, #764ba2);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .container {
    background: #fff;
    border-radius: 16px;
    padding: 40px 30px;
    box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    max-width: 450px;
    width: 100%;
    transition: transform 0.3s ease;
  }
  .container:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 36px rgba(0,0,0,0.25);
  }

  h5 {
    font-weight: 600;
    color: #4a4a4a;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  h5 i {
    color: #764ba2;
    font-size: 28px;
    animation: pulse 2.5s infinite;
  }

  @keyframes pulse {
    0%, 100% {opacity: 1;}
    50% {opacity: 0.6;}
  }

  label {
    font-weight: 600;
    color: #555;
  }

  input.form-control {
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 16px;
    transition: box-shadow 0.3s ease;
  }
  input.form-control:focus {
    box-shadow: 0 0 8px 2px #764ba2;
    border-color: #764ba2;
  }

  .btn-primary {
    background: linear-gradient(90deg, #667eea, #764ba2);
    border: none;
    padding: 14px 0;
    font-weight: 600;
    font-size: 18px;
    border-radius: 10px;
    box-shadow: 0 6px 14px rgba(118, 75, 162, 0.5);
    transition: background 0.3s ease, box-shadow 0.3s ease;
  }
  .btn-primary:hover {
    background: linear-gradient(90deg, #764ba2, #667eea);
    box-shadow: 0 10px 22px rgba(118, 75, 162, 0.7);
  }

  .alert {
    border-radius: 10px;
    font-weight: 600;
    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    animation: slideDown 0.4s ease forwards;
  }

  @keyframes slideDown {
    0% {opacity: 0; transform: translateY(-15px);}
    100% {opacity: 1; transform: translateY(0);}
  }

  small.text-danger {
    font-weight: 600;
    margin-top: 6px;
    display: block;
  }
</style>
</head>
<body>

<div class="container">
    <h5><i class="fas fa-user-check"></i> Masukkan Username</h5>

    @if(session('error'))
        <div class="alert alert-danger" id="alert-message">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('password.username.check') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input id="username" name="username" type="text" class="form-control" required autofocus>
            @error('username')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Lanjutkan</button>
    </form>
</div>

<script src="https://kit.fontawesome.com/a2e2f7cfd5.js" crossorigin="anonymous"></script>
</body>
<script>
        setTimeout(() => {
        const alert = document.getElementById('alert-message');
        if (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500); // hapus dari DOM setelah hilang
        }
    }, 3000);
</script>
</html>
