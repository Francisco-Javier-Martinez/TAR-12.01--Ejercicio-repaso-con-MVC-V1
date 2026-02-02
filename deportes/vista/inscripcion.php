<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inscripción</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h5><a href="index.php">Volver</a></h5>
    <form action="index.php?controlador=Inscripcion&metodo=registrarUsuario" method="POST">
        <label for="username">Nombre usuario: (no se puede repetir)</label>
        <input type="text" name="username"/>
        <br/><br/>
        <label for="nombre_completo">Apellidos y Nombre:</label>
        <input type="text" name="nombre_completo"/>
        <br/><br/>
        <label for="password">Contraseña:</label>
        <input type="password" name="password"/>
        <br/><br/>
        <label for="email">Correo:</label>
        <input type="email" name="email"/>
        <br/><br/>
        <label for="telefono">Teléfono: </label>
        <input type="tel" name="telefono" placeholder="Opcional"/>
        <br/><br/>
        <label >Deportes: (un alumno puede inscribirse en más de un deporte)</label>
        <br/><br/>
        <?php
            // Validamos que $datos exista si no es qu no hay juegos en la bd
            if (isset($datos)) {
                foreach($datos as $deporte) {
                    echo '<label for="'.$deporte['idDeporte'].'"><input type="checkbox" name="deportes[]" value="'.$deporte['idDeporte'].'"/> '.$deporte['nombreDep'].'</label><br/>';
                }
            } else {
                echo "<p>No hay deportes disponibles en este momento.</p>";
            }
        ?>
        <br/><br/>
        <label>
            Acepto las condiciones <input type="checkbox" name="condiciones"/> **
        </label>
        <br/><br/>
        <button type="submit">ENVIAR</button>
    </form>
</body>
</html>