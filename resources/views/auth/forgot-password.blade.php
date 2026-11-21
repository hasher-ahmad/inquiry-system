
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password | ELC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="auth-page">
<div class="auth-card">
    <div class="auth-brand">
        <span class="brand-icon">E</span>
        <div><h3>ELC Institute</h3><p>Account recovery</p></div>
    </div>

    <div class="auth-heading">
        <h1>Forgot password?</h1>
        <p>Enter your registered email to receive a password reset link.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label>Email address</label>
        <input class="form-control auth-input" type="email" name="email"
               value="{{ old('email') }}" placeholder="you@example.com" required>
        <button class="btn-primary-custom w-100 mt-4" type="submit">
            Send Reset Link →
        </button>
    </form>

    <p class="auth-footer"><a href="{{ route('login') }}">← Back to login</a></p>
</div>
</body>
</html>
