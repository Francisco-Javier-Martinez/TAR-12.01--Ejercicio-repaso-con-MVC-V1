<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Deportes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card">
        <h2>Total de deportes inscritos</h2>
        <p><?php echo  $datos['TotalDeporte']; ?></p>
        <a href="index.php?controlador=Usuarios&metodo=volverPanelAdmin">Volver al inicio</a>
    </div>
</body>
</html>