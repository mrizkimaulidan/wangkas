<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/auth.css') }}">
</head>

<body>
    <div id="auth">
        @yield('content')

    </div>
</body>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</html>