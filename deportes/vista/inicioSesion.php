<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio sesion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="index.php?controlador=Usuarios&metodo=iniciarSesion" method="post" id="loginForm">
        <h2>Iniciar Sesión</h2>
        <label for="nombre">Nombre de usuario:</label>
        <input type="text" id="nombre" name="nombre"><br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>