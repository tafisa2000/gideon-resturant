<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to our Platform</title>
</head>
<body>
    <h1>Welcome, {{ $user->first_name }}</h1>
    <p>Your account has been created successfully, Youre default password is <strong>{{ $password }}</strong></p>
    <p>Please change password after login In</p>
</body>
</html>