<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel + Vue</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    @inertia
</body>
</html>
