<?php
include("conexion.php");

// Guardar cita en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $id_mascota = $_POST['id_mascota'];
    $id_servicio = $_POST['id_servicio'];

    // Buscar dueño de la mascota automáticamente
    $dueño = $conn->query("SELECT id_cliente FROM mascotas WHERE id_mascota='$id_mascota'");
    $row = $dueño->fetch_assoc();
    $id_cliente = $row['id_cliente'];

    $sql = "INSERT INTO citas (fecha, id_mascota, id_cliente, id_servicio, estado) 
            VALUES ('$fecha $hora', '$id_mascota', '$id_cliente', '$id_servicio', 'Pendiente')";

    if ($conn->query($sql) === TRUE) {
        // Obtener nombre del cliente
        $cliente = $conn->query("SELECT nombre FROM clientes WHERE id_cliente='$id_cliente'");
        $rowCliente = $cliente->fetch_assoc();
        $nombreCliente = $rowCliente['nombre'];

        // Mensaje personalizado
        $mensaje = "¡Hola, $nombreCliente! Te recordamos tu cita para el $fecha a las $hora en NexaCode. 
        Por favor avísanos si necesitas cambiar el horario. ¡Te esperamos!";
    } else {
        $mensaje = "Error: " . $conn->error;
    }
} // ← AQUÍ faltaba cerrar la llave del if principal

// Obtener lista de mascotas
$mascotas = $conn->query("SELECT id_mascota, nombre FROM mascotas");
// Obtener lista de servicios
$servicios = $conn->query("SELECT id_servicio, nombre FROM servicios");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agendar Cita</title>
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
    <h2 style="text-align:center;">Agendar Cita</h2>
    <form method="POST" action="">
        <label>Fecha:</label>
        <input type="date" name="fecha" required>
        
        <label>Hora:</label>
        <input type="time" name="hora" required>
        
        <label>Mascota:</label>
        <select name="id_mascota" required>
            <option value="">Seleccione la mascota</option>
            <?php
            if ($mascotas->num_rows > 0) {
                while($row = $mascotas->fetch_assoc()) {
                    echo "<option value='".$row["id_mascota"]."'>".$row["nombre"]."</option>";
                }
            }
            ?>
        </select>
        
        <label>Servicio:</label>
        <select name="id_servicio" required>
            <option value="">Seleccione el servicio</option>
            <option value="1">Consulta General - $200</option>
            <option value="2">Vacunación - $350</option>
            <option value="3">Baño y Corte - $400</option>
            <option value="4">Desparasitación - $250</option>
        </select>

        <button type="submit">Agendar</button>
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