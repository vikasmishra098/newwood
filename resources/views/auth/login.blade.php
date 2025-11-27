

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family: 'Poppins', sans-serif;
        margin: 0;
    }

    .login-container {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 400px;
        padding: 40px 35px;
        
        animation: fadeIn 0.5s ease-in-out;
    }

    .login-container img {
        width: 100px;
        margin-bottom: 15px;
    }

    .login-container h3 {
        font-weight: 600;
        color: #1e3a8a;
        margin-bottom: 25px;
    }

    .form-control {
        text-align: justify;
        width: 100%;
        border-radius: 10px;
        border: 1px solid #d0d0d0;
        padding: 12px;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #1e40af;
        box-shadow: 0 0 6px rgba(30, 64, 175, 0.2);
    }

    .btn-primary {
        background: #1e40af;
        border: none;
        border-radius: 10px;
        padding: 12px;
        width: 100%;
        color: white;
        font-weight: 500;
        margin-top: 10px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: #15318a;
        transform: translateY(-2px);
    }

    .form-check-label {
        font-size: 14px;
        color: #333;
    }

    .forgot-password {
        display: block;
        margin-top: 10px;
        font-size: 14px;
        color: #1e40af;
        text-decoration: none;
        transition: 0.3s;
    }

    .forgot-password:hover {
        text-decoration: underline;
    }

    .register-link {
        margin-top: 20px;
        font-size: 14px;
        color: #444;
    }

    .register-link a {
        color: #1e40af;
        font-weight: 500;
        text-decoration: none;
    }

    .register-link a:hover {
        text-decoration: underline;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 480px) {
        .login-container {
            margin: 20px;
            padding: 30px 25px;
        }
    }
</style>

<div class="login-container">
   <center> <img src="https://www.woodedgetooling.com/admin/uploads/logo.png" alt="Wood Edge Tooling Logo">
    <h3>Welcome Back</h3>
</center>
    <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3 text-start">
        <label for="login" class="form-label" style="text-align: justify;">{{ __('Email or Employee ID :') }}</label>
        <br>
        <input id="login" type="text"
       class="form-control @error('login') is-invalid @enderror"
       name="login" value="{{ old('login') }}" required autofocus>

        @error('login')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3 text-start">
        <label for="password" class="form-label" style="text-align: justify;">{{ __('Password :') }}</label>
        <br>
        <input id="password" type="password"
               class="form-control @error('password') is-invalid @enderror"
               name="password" required autocomplete="current-password">
        @error('password')
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
</form>

</div>

