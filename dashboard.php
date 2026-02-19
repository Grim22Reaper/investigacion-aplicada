<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }
        .card {
            border-radius: 15px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">🌐 Mi Aplicación Escalable</span>
        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>
</nav>

<div class="container mt-5">
    <div class="card shadow p-4 text-center">
        <h2>Bienvenido, <?php echo $_SESSION["usuario"]; ?> 👋</h2>
        <p class="mt-3">Tu sesión está activa correctamente.</p>
        <hr>
        <p>Este sistema está desplegado en Docker y Kubernetes con escalabilidad horizontal.</p>
    </div>
</div>

</body>
</html>
