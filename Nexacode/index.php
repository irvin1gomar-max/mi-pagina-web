<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "nexacodel";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar próximas citas
$sql = "SELECT c.fecha, m.nombre AS mascota, cl.nombre AS cliente, s.nombre AS servicio, c.estado
        FROM citas c
        INNER JOIN mascotas m ON c.id_mascota = m.id_mascota
        INNER JOIN clientes cl ON c.id_cliente = cl.id_cliente
        INNER JOIN servicios s ON c.id_servicio = s.id_servicio
        ORDER BY c.fecha ASC
        LIMIT 5";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>NexaCode - Sistema de Citas Veterinarias</title>
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Estilos externos -->
    <link rel="stylesheet" href="styles.css">

   <script>
    // Lista de imágenes para el carrusel superior
    const imagenesCarrusel = [
        "foto_fondo1.jpg",
        "foto_fondo2.jpg",
        "foto_fondo3.jpg",
        "foto_fondo4.jpg"
    ];
    let indiceCarrusel = 0;

    function cambiarCarrusel() {
        document.querySelector('.carousel').style.backgroundImage = `url('${imagenesCarrusel[indiceCarrusel]}')`;
        indiceCarrusel = (indiceCarrusel + 1) % imagenesCarrusel.length;
    }

    // Cambiar cada 4 segundos
    setInterval(cambiarCarrusel, 4000);

    // Mostrar la primera imagen al cargar
    window.onload = cambiarCarrusel;
   </script>
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="logo.jpeg" alt="Logo NexaCode">
            <h1>NexaCode - Sistema de Citas Veterinarias</h1>
        </div>
        <nav>
            <a href="#"><i class="fas fa-home"></i> Inicio</a>
            <a href="clientes.php"><i class="fas fa-user"></i> Clientes</a>
            <a href="mascotas.php"><i class="fas fa-dog"></i> Mascotas</a>
            <a href="agendar.php"><i class="fas fa-calendar"></i> Citas</a>
            <a href="servicios.php"><i class="fas fa-stethoscope"></i> Servicios</a>
            <a href="historial.php"><i class="fas fa-list"></i> Historial</a>
            <a href="login.php"><i class="fas fa-user-shield"></i> Admin</a>
        </nav>
        <div class="search-bar">
            <input type="text" placeholder="Buscar por Cliente">
            <button>Buscar</button>
        </div>
    </header>

    <!-- Carrusel superior -->
    <div class="carousel">
        <div class="carousel-text">
            <h1>Bienvenido a NexaCode</h1>
        </div>
    </div>

    <div class="container">
        <div class="welcome">
            <h2>Bienvenido al Sistema de Citas Veterinarias</h2>
        </div>

        <div class="buttons">
            <button onclick="window.location.href='agendar.php'">
                <i class="fas fa-calendar-plus"></i> Agendar Cita
            </button>
            <button onclick="window.location.href='historial.php'">
                <i class="fas fa-history"></i> Ver Historial
            </button>
        </div>

        <div class="features">
            <div class="feature-box" onclick="window.location.href='clientes.php'"><i class="fas fa-user-plus"></i> Registrar Cliente</div>
            <div class="feature-box" onclick="window.location.href='mascotas.php'"><i class="fas fa-dog"></i> Registrar Mascota</div>
            <div class="feature-box" onclick="window.location.href='agendar.php'"><i class="fas fa-calendar-check"></i> Agenda de Citas</div>
            <div class="feature-box" onclick="window.location.href='servicios.php'"><i class="fas fa-stethoscope"></i> Servicios</div>
        </div>

        <!-- Sidebar búsqueda rápida -->
        <aside class="sidebar">
            <h3>Búsqueda Rápida</h3>
            <input type="text" placeholder="Buscar por Cliente">
            <button>Buscar</button>
        </aside>

        <h3><i class="fas fa-clock"></i> Próximas Citas</h3>
        <table>
            <tr>
                <th>Fecha</th>
                <th>Mascota</th>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Estado</th>
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
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay citas registradas</td></tr>";
            }
            ?>
        </table>
    </div>

    <footer>
        © 2024 NexaCode - Sistema de Citas Veterinarias |
        <a href="#">Políticas de Privacidad</a> |
        <a href="#">Términos y Condiciones</a> |
        <a href="#">Contacto</a>
    </footer>
</body>
</html>
