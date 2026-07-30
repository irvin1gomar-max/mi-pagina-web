<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Servicios Veterinarios</title>
    <style>
        body { font-family: Arial; background:#f9f9f9; margin:0; padding:0; }
        header { background:#28a745; color:white; padding:15px; text-align:center; }
        .container { max-width:800px; margin:30px auto; text-align:center; }
        .service-box {
            background:white; 
            border:1px solid #28a745; 
            border-radius:8px; 
            padding:20px; 
            margin:15px; 
            display:inline-block; 
            width:200px; 
            cursor:pointer;
        }
        .service-box:hover { background:#e6ffe6; }
        .service-title { font-weight:bold; color:#1e7e34; margin-bottom:10px; }
        .service-price { color:#333; margin-bottom:15px; }
        .back-button {
            background:#28a745; 
            color:white; 
            border:none; 
            padding:10px 20px; 
            border-radius:5px; 
            cursor:pointer; 
            margin-top:20px;
        }
        .back-button:hover { background:#1e7e34; }
    </style>
</head>
<body>
    <header>
        <h1>NexaCode - Servicios</h1>
    </header>
    <div class="container">
        <h2>Selecciona un Servicio</h2>
        
        <div class="service-box" onclick="alert('Has seleccionado Consulta General - $200')">
            <div class="service-title">Consulta General</div>
            <div class="service-price">$200</div>
            <button>Seleccionar</button>
        </div>
        
        <div class="service-box" onclick="alert('Has seleccionado Vacunación - $350')">
            <div class="service-title">Vacunación</div>
            <div class="service-price">$350</div>
            <button>Seleccionar</button>
        </div>
        
        <div class="service-box" onclick="alert('Has seleccionado Baño y Corte - $400')">
            <div class="service-title">Baño y Corte</div>
            <div class="service-price">$400</div>
            <button>Seleccionar</button>
        </div>
        
        <div class="service-box" onclick="alert('Has seleccionado Desparasitación - $250')">
            <div class="service-title">Desparasitación</div>
            <div class="service-price">$250</div>
            <button>Seleccionar</button>
        </div>
        
<div style="text-align:center; margin-top:20px;">
    <button onclick="location.href='index.php'" 
            style="background:#28a745; color:white; border:none; padding:10px 20px; border-radius:5px; cursor:pointer;">
        Regresar al Inicio
    </button>
</div>
    </div>
</body>
</html>
