<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.php?controlador=Deportes&metodo=verDeportes">Volver a la lista de deportes</a>
    <div>
        <h2>Imagen actual</h2>
        <?php
            echo "<img src='".$datos['imagen']."' alt='Imagen del deporte' width='500' height='500'>";
        ?>
    </div>
    <form action="index.php?controlador=Deportes&metodo=guardarEdicion&id=<?php echo $datos['idDeporte']; ?>" method="POST" enctype="multipart/form-data">
        <h1>Editar Deporte</h1>
        <div>
            <label for="nombreDep">Nombre del Deporte:</label>
            <input type="text" id="nombreDep" name="nombreDep" value="<?php echo $datos['nombreDep']; ?>">
        </div>
        <div>
            <label for="imagen">Nueva Imagen del Deporte (opcional):</label>
            <input type="file" id="imagen" name="imagen">
        </div>
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>