<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sesión Cerrada</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #232526, #414345);
        }
        .card {
            border-radius: 15px;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

<div class="card shadow-lg p-4 text-center" style="width: 400px;">
    <h3 class="mb-3">👋 Sesión Cerrada</h3>
    <p>Has cerrado sesión correctamente.</p>
    <a href="index.php" class="btn btn-primary mt-3">Volver al Login</a>
</div>

</body>
</html>
