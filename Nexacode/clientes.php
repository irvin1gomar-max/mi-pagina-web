<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    $sql = "INSERT INTO clientes (nombre, telefono, correo) VALUES ('$nombre', '$telefono', '$correo')";
    if ($conn->query($sql) === TRUE) {
        $mensaje = "Cliente registrado correctamente.";
    } else {
        $mensaje = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Clientes</title>
    <style>
        body { font-family: Arial; background:#f9f9f9; }
        header { background:#28a745; color:white; padding:15px; }
        form { max-width:400px; margin:50px auto; background:white; padding:20px; border-radius:8px; }
        input { width:100%; padding:10px; margin:10px 0; }
        button { background:#28a745; color:white; border:none; padding:10px; width:100%; cursor:pointer; }
        button:hover { background:#1e7e34; }
    </style>
</head>
<body>
    <header>
        <h1>NexaCode</h1>
    </header>
    <h2 style="text-align:center;">Registro de Clientes</h2>
    <form method="POST" action="">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <label>Teléfono:</label>
        <input type="text" name="telefono">
        <label>Correo:</label>
        <input type="email" name="correo">
        <button type="submit">Guardar</button>
    </form>
    <?php if(isset($mensaje)) echo "<p style='text-align:center;color:green;'>$mensaje</p>"; ?>
    <div style="text-align:center; margin-top:20px;">
    <button onclick="location.href='index.php'" 
            style="background:#28a745; color:white; border:none; padding:10px 20px; border-radius:5px; cursor:pointer;">
        Regresar al Inicio
    </button>
</div>
</body>
</html>
