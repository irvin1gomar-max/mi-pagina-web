<?php
include("conexion.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM administrador WHERE usuario='$usuario' AND contrasena='$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['admin'] = $usuario;
        header("Location: index.php"); // Redirige al inicio
        exit();
    } else {
        $mensaje = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #28a745, #218838);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.3);
            width: 350px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #28a745;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #1e7e34;
        }
        .back-button {
            margin-top: 15px;
            background: #6c757d;
        }
        .back-button:hover {
            background: #5a6268;
        }
        .mensaje {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login Administrador</h2>
        <form method="POST" action="">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="contrasena" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <button class="back-button" onclick="location.href='index.php'">Regresar al Inicio</button>
        <?php if(isset($mensaje)) echo "<p class='mensaje'>$mensaje</p>"; ?>
    </div>
</body>
</html>
