<?php
session_start();

$usuario_valido = "admin";
$password_valido = "1234";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    if ($usuario === $usuario_valido && $password === $password_valido) {
        $_SESSION["usuario"] = $usuario;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Credenciales incorrectas";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #141e30, #243b55);
        }
        .card {
            border-radius: 15px;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

<div class="card shadow-lg p-4" style="width: 380px;">
    <h3 class="text-center mb-3">🔐 Iniciar Sesión</h3>

    <?php if(isset($error)) { ?>
        <div class="alert alert-danger text-center">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="POST">
        <div class="mb-3">
            <label>Usuario</label>
            <input type="text" name="usuario" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
    </form>
</div>

</body>
</html>
