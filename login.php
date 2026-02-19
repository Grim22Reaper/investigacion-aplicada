<?php
session_start();

// Si ya está logueado, redirigir
if (isset($_SESSION["usuario"])) {
    header("Location: dashboard.php");
    exit();
}

$usuario_valido = "admin";
$password_valido = "1234";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = trim($_POST["usuario"]);
    $password = trim($_POST["password"]);

    if ($usuario === $usuario_valido && $password === $password_valido) {
        $_SESSION["usuario"] = $usuario;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
        }

        .login-card {
            width: 400px;
            border-radius: 20px;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-control {
            border-radius: 12px;
        }

        .btn-login {
            border-radius: 12px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            transform: scale(1.03);
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

<div class="card login-card shadow-lg p-4">

    <div class="text-center mb-4">
        <i class="bi bi-person-circle" style="font-size: 3rem; color:#0d6efd;"></i>
        <h3 class="mt-2">Iniciar Sesión</h3>
        <p class="text-muted">Accede al sistema</p>
    </div>

    <?php if(isset($error)) { ?>
        <div class="alert alert-danger text-center">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-person"></i>
                </span>
                <input type="text" name="usuario" class="form-control" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Contraseña</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>
                <input type="password" name="password" class="form-control" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-login w-100">
            <i class="bi bi-box-arrow-in-right"></i> Ingresar
        </button>

    </form>

    <div class="text-center mt-4">
        <small class="text-muted">
            Proyecto desplegado con Docker + Kubernetes 🚀
        </small>
    </div>

</div>

</body>
</html>
