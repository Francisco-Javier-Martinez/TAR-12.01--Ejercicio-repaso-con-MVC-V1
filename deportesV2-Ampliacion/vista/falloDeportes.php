<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>
<body>
    <h5><a href="index.php?controlador=Deportes&metodo=verDeportes">Volver a deportes</a></h5>
    <?php
        if(isset($mensajeError)){
            echo "<h3>" . $mensajeError . "</h3>";
        }
    ?>
</body>
</html>