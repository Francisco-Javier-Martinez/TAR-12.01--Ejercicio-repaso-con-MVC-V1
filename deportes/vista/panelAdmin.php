<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Panel de Administrador</h1>
        <h2>Bienvenido <?php echo $_SESSION['nombreUsuario']; ?></h2>
    </header>
    <nav id="adminNav">
        <ul>
            <li><a href="index.php?controlador=Inscripcion&metodo=obtenerInscripciones">Deportes_Usuarios</a></li>
            <li><a href="index.php?controlador=Inscripcion&metodo=totalDeportesInscritos">Total Deportes</a></li>
            <li><a href="index.php?controlador=Inscripcion&metodo=totalInscripcionesPorDeporte">Total Inscripciones por Deporte</a></li>
            <li><a href="index.php?controlador=Usuarios&metodo=cerrarSesion">Cerrar sesión</a></li>
        </ul>
    </nav>
    <main id="adminMain">
        <section class="card">
            <h3>Resumen</h3>
            <p>Aquí puedes ver estadísticas y acciones de administración</p>
        </section>
    </main>
</body>
</html>