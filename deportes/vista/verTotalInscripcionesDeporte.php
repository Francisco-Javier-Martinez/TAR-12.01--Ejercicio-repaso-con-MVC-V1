<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Total de inscripciones por deporte</h2>
    <ul>
        <?php
            foreach($datos as $total){
                echo "<li>Deporte: ".$total['nombreDep']." - Total de inscritos: ".$total['Total_Gente_Inscrita']."</li>";
            }
        ?>
    </ul>
    <a href="index.php?controlador=Usuarios&metodo=volverPanelAdmin">Volver al inicio</a>
</body>
</html>