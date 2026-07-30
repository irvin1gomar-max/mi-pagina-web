<?php
include("conexion.php");

// Guardar mascota en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $especie = $_POST['especie'];
    $edad = $_POST['edad'];
    $id_cliente = $_POST['id_cliente'];

    $sql = "INSERT INTO mascotas (nombre, especie, edad, id_cliente) 
            VALUES ('$nombre', '$especie', '$edad', '$id_cliente')";
    if ($conn->query($sql) === TRUE) {
        $mensaje = "Mascota registrada correctamente.";
    } else {
        $mensaje = "Error: " . $conn->error;
    }
}

// Obtener lista de clientes para el menú desplegable
$clientes = $conn->query("SELECT id_cliente, nombre FROM clientes");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Mascotas</title>
    <style>
        body { font-family: Arial; background:#f9f9f9; }
        header { background:#28a745; color:white; padding:15px; }
        form { max-width:400px; margin:50px auto; background:white; padding:20px; border-radius:8px; }
        input, select { width:100%; padding:10px; margin:10px 0; }
        button { background:#28a745; color:white; border:none; padding:10px; width:100%; cursor:pointer; }
        button:hover { background:#1e7e34; }
    </style>
</head>
<body>
    <header>
        <h1>NexaCode</h1>
    </header>
    <h2 style="text-align:center;">Registro de Mascotas</h2>
    <form method="POST" action="">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        
        <label>Especie:</label>
        <input type="text" name="especie" required>
        
        <label>Edad:</label>
        <input type="number" name="edad" required>
        
        <label>Dueño:</label>
        <select name="id_cliente" required>
            <option value="">Seleccione el dueño</option>
            <?php
            if ($clientes->num_rows > 0) {
                while($row = $clientes->fetch_assoc()) {
                    echo "<option value='".$row["id_cliente"]."'>".$row["nombre"]."</option>";
                }
            }
            ?>
        </select>
        
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
