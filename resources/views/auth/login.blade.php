
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | ELC Inquiry System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="auth-page">
<div class="auth-card">
    <div class="auth-brand">
        <span class="brand-icon">E</span>
        <div><h3>ELC Institute</h3><p>Inquiry Management Portal</p></div>
    </div>

    <div class="auth-heading">
        <h1>Welcome back!</h1>
        <p>Login to manage student inquiries.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <label>Email address</label>
        <input class="form-control auth-input" type="email" name="email"
               value="{{ old('email') }}" placeholder="you@example.com" required>

        <label class="mt-3">Password</label>
        <input class="form-control auth-input" type="password" name="password"
               placeholder="Enter your password" required>

        <div class="auth-options">
            <label class="remember-label">
                <input type="checkbox" name="remember" value="1"> Remember me
            </label>
            <a href="{{ route('password.request') }}">Forgot password?</a>
        </div>

        <button class="btn-primary-custom w-100" type="submit">Login to Dashboard →</button>
    </form>

    <p class="auth-footer">New here? <a href="{{ route('signup') }}">Create an account</a></p>
</div>
</body>
</html>
