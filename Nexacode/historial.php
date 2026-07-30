<?php
include("conexion.php");

// Actualizar estado y observaciones si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_cita'])) {
    $id_cita = $_POST['id_cita'];
    $nuevo_estado = $_POST['estado'];
    $observaciones = $_POST['observaciones'];

    $sqlUpdate = "UPDATE citas SET estado='$nuevo_estado', observaciones='$observaciones' WHERE id_cita='$id_cita'";
    $conn->query($sqlUpdate);
}

// Obtener todas las citas
$sql = "SELECT c.id_cita, c.fecha, m.nombre AS mascota, cl.nombre AS cliente, s.nombre AS servicio, c.estado, c.observaciones
        FROM citas c
        INNER JOIN mascotas m ON c.id_mascota = m.id_mascota
        INNER JOIN clientes cl ON c.id_cliente = cl.id_cliente
        INNER JOIN servicios s ON c.id_servicio = s.id_servicio
        ORDER BY c.fecha ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Citas</title>
    <style>
        body { font-family: Arial; background:#f9f9f9; }
        header { background:#28a745; color:white; padding:15px; text-align:center; }
        table { width:95%; margin:30px auto; border-collapse:collapse; }
        th, td { border:1px solid #ccc; padding:10px; text-align:center; vertical-align:top; }
        th { background:#28a745; color:white; }
        textarea { width:100%; height:60px; }
        select, button { padding:5px; margin-top:5px; }
        .back-button {
            display:block; margin:20px auto; 
            background:#28a745; color:white; border:none; 
            padding:10px 20px; border-radius:5px; cursor:pointer;
        }
        .back-button:hover { background:#1e7e34; }
    </style>
</head>
<body>
    <header>
        <h1>NexaCode - Historial de Citas</h1>
    </header>
    <h2 style="text-align:center;">Listado de Citas</h2>
    <table>
        <tr>
            <th>Fecha</th>
            <th>Mascota</th>
            <th>Cliente</th>
            <th>Servicio</th>
            <th>Estado</th>
            <th>Observaciones</th>
            <th>Acción</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["fecha"]."</td>
                        <td>".$row["mascota"]."</td>
                        <td>".$row["cliente"]."</td>
                        <td>".$row["servicio"]."</td>
                        <td>".$row["estado"]."</td>
                        <td>".nl2br($row["observaciones"])."</td>
                        <td>
                            <form method='POST' action=''>
                                <input type='hidden' name='id_cita' value='".$row["id_cita"]."'>
                                <select name='estado'>
                                    <option value='Pendiente' ".($row["estado"]=="Pendiente"?"selected":"").">Pendiente</option>
                                    <option value='Confirmada' ".($row["estado"]=="Confirmada"?"selected":"").">Confirmada</option>
                                    <option value='Cancelada' ".($row["estado"]=="Cancelada"?"selected":"").">Cancelada</option>
                                </select><br>
                                <textarea name='observaciones'>".$row["observaciones"]."</textarea><br>
                                <button type='submit'>Actualizar</button>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay citas registradas</td></tr>";
        }
        ?>
    </table>
    <button class="back-button" onclick="location.href='index.php'">Regresar al Inicio</button>
</body>
</html>
