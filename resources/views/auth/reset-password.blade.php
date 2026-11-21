
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password | ELC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="auth-page">
<div class="auth-card">
    <div class="auth-brand">
        <span class="brand-icon">E</span>
        <div><h3>ELC Institute</h3><p>Secure password reset</p></div>
    </div>

    <div class="auth-heading">
        <h1>Set new password</h1>
        <p>Choose a new password for your account.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <label>Email address</label>
        <input class="form-control auth-input" type="email" name="email"
               value="{{ old('email', $email) }}" required>

        <label class="mt-3">New password</label>
        <input class="form-control auth-input" type="password" name="password"
               minlength="8" required>

        <label class="mt-3">Confirm new password</label>
        <input class="form-control auth-input" type="password"
               name="password_confirmation" minlength="8" required>

        <button class="btn-primary-custom w-100 mt-4" type="submit">
            Reset Password
        </button>
    </form>
</div>
</body>
</html>
