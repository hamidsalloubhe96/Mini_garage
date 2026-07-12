<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mot de passe oublié — Garage Manager</title>
    @viteReactRefresh
    @vite(['resources/js/app.jsx'])
</head>
<body style="margin:0; padding:0;">
    <div id="forgot-root"></div>
</body>
</html>