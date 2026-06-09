<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Admin - Perusahaan Testing Project</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
  @vite(['resources/css/home.css'])
  <style>
    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--warm-white, #fdfaf5);
      padding: 20px;
    }
    .login-card {
      background: #fff;
      border-radius: 20px;
      padding: 48px 40px;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 4px 30px rgba(0,0,0,0.08);
      border: 1px solid rgba(0,0,0,0.05);
    }
    .login-logo {
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      font-weight: 700;
      text-align: center;
      margin-bottom: 8px;
      color: var(--text-dark, #0d1f10);
    }
    .login-logo span {
      color: var(--green-accent, #22a05a);
    }
    .login-subtitle {
      text-align: center;
      color: var(--text-mid, #3a5240);
      font-size: 0.9rem;
      margin-bottom: 32px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-group label {
      display: block;
      font-size: 0.85rem;
      font-weight: 600;
      color: var(--text-dark, #0d1f10);
      margin-bottom: 6px;
    }
    .form-group input {
      width: 100%;
      padding: 12px 16px;
      border: 1.5px solid #e5e7eb;
      border-radius: 10px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.95rem;
      outline: none;
      transition: border-color 0.2s;
      box-sizing: border-box;
    }
    .form-group input:focus {
      border-color: var(--green-accent, #22a05a);
    }
    .btn-login {
      width: 100%;
      padding: 14px;
      background: var(--green-accent, #22a05a);
      color: #fff;
      border: none;
      border-radius: 10px;
      font-family: 'DM Sans', sans-serif;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
    }
    .btn-login:hover {
      background: var(--green-light, #4fd183);
    }
    .error-box {
      background: #fef2f2;
      border: 1px solid #fecaca;
      color: #991b1b;
      padding: 12px 16px;
      border-radius: 10px;
      font-size: 0.85rem;
      margin-bottom: 20px;
    }
    .back-link {
      text-align: center;
      margin-top: 20px;
    }
    .back-link a {
      color: var(--text-mid, #3a5240);
      font-size: 0.85rem;
      text-decoration: none;
    }
    .back-link a:hover {
      color: var(--green-accent, #22a05a);
    }
  </style>
</head>
<body>

<div class="login-container">
  <div class="login-card">
    <div class="login-logo">
      Perusahaan<span> Testing</span> Project
    </div>
    <div class="login-subtitle">Login Admin Panel</div>

    @if ($errors->any())
      <div class="error-box">
        {{ $errors->first('email') }}
      </div>
    @endif

    <form method="POST" action="{{ route('auth.login') }}">
      @csrf
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="btn-login">Login</button>
    </form>

    <div class="back-link">
      <a href="{{ url('/') }}">← Kembali ke Beranda</a>
    </div>
  </div>
</div>

</body>
</html>
