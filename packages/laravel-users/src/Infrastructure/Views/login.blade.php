<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Puedes incluir aquí tus enlaces CSS -->
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf <!-- Esto genera automáticamente el campo de token CSRF -->

        <!-- Campo de email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required  value="arneon4@gmail.com">
        </div>

        <!-- Campo de password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required value="12345678">
        </div>

        <!-- Botón de submit -->
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</body>
</html>
