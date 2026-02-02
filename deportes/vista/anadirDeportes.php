<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Deporte</title>
    <link rel="stylesheet" href="style.css">
</head>
<body> 
    <a href="index.php?controlador=Deportes&metodo=verDeportes">Volver</a>
    <div class="anadir-deporte-container">
        <h1>Añadir Nuevo Deporte</h1>
        <form action="index.php?controlador=Deportes&metodo=guardarDeporte" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombreDep">Nombre del Deporte:</label>
                <input type="text" id="nombreDep" name="nombreDep">
            </div>
            <div class="form-group">
                <label for="imagen">Imagen del Deporte:</label>
                <input type="file" id="imagen" name="imagen"">
            </div>
            <button type="submit" class="btn-submit">Añadir Deporte</button>
        </form>
    </div>
</body>
</html>