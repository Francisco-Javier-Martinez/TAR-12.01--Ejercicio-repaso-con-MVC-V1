<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="deportes-container">
        <h1>Vista de Deportes</h1>
        <h2><a href="index.php?controlador=Usuarios&metodo=volverPanelAdmin">Volver atras</a></h2>
        <h2><a href="index.php?controlador=Deportes&metodo=crearDeporte">Añadir Deporte</a></h2>
        <div class="deportes-list">
            <?php 
            if (isset($datos)) {
                foreach($datos as $deporte) {
                    echo "<div class='deporte-item'>";
                        //si la imagen no es nula o vacia la mostramos, si no mostramos un mensaje
                        if($deporte['imagen']!=null && $deporte['imagen']!=''){
                            echo "<img src='".$deporte['imagen']."' alt='".$deporte['nombreDep']."' width='60' height='60'>";
                        } else {
                            echo "<p>No hay imagen</p>";
                        }
                        echo "<p>".$deporte['nombreDep']."</p>";
                        echo "<div class='deporte-actions'>";
                            echo "<a href='index.php?controlador=Deportes&metodo=mostrarEditar&id=".$deporte['idDeporte']."'>Editar</a>";
                            echo "<a href='index.php?controlador=Deportes&metodo=eliminar&id=".$deporte['idDeporte']."'>Eliminar</a>";
                        echo "</div>";

                    echo "</div>";
                }
            } else {
                echo "<p>No hay deportes disponibles en este momento.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>