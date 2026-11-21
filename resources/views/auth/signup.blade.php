
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up | ELC Institute</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="auth-page">
<div class="auth-card">
    <div class="auth-brand">
        <span class="brand-icon">E</span>
        <div><h3>ELC Institute</h3><p>Create your portal account</p></div>
    </div>

    <div class="auth-heading">
        <h1>Create account</h1>
        <p>Register to access the inquiry system.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('signup.submit') }}" method="POST">
        @csrf
        <label>Full name</label>
        <input class="form-control auth-input" name="name"
               value="{{ old('name') }}" placeholder="Your full name" required>

        <label class="mt-3">Email address</label>
        <input class="form-control auth-input" type="email" name="email"
               value="{{ old('email') }}" placeholder="you@example.com" required>

        <label class="mt-3">Password</label>
        <input class="form-control auth-input" type="password" name="password"
               minlength="8" placeholder="At least 8 characters" required>

        <label class="mt-3">Confirm password</label>
        <input class="form-control auth-input" type="password"
               name="password_confirmation" minlength="8"
               placeholder="Repeat your password" required>

        <button class="btn-primary-custom w-100 mt-4" type="submit">Create Account →</button>
    </form>

    <p class="auth-footer">Already registered? <a href="{{ route('login') }}">Login</a></p>
</div>
</body>
</html>
