<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripcion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Inscripciones realizadas</h2>
    <div class="card">
        <ul><?php
            foreach($datos as $inscripcion){
                echo "<li>Usuario: ".$inscripcion['nombreUsuario']." - Deporte: ".$inscripcion['nombreDep']."</li>";
            }
        ?></ul>
        <a href="index.php?controlador=Usuarios&metodo=volverPanelAdmin">Volver al inicio</a>
    </div>
</body>
</html>