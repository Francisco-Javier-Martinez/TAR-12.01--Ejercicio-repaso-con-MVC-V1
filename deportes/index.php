<?php
    require_once __DIR__ . "/config/configrt.php";

    if(!isset($_GET['controlador'])){
        $controlador=DEFAULT_CONTROLLER;
    }else{
        $controlador=$_GET['controlador'];
    }

    if(!isset($_GET['metodo'])){
        $metodo = DEFAULT_METHOD;
    }else{
        $metodo=$_GET['metodo']; 
    }

    //ponemos la ruta del controlador en una variable para que sea más facil
    //concatenamos el archivo del controlador

    $rutaControlador = "controlador/c".$controlador.".php";

    //incluimos el controlador
    include $rutaControlador;

    //ponemos la clase del controlador concatenada
    $nombreClase= "C".$controlador;
    $controlador = new $nombreClase();
    //ejecutamos la accion / metodo
    $datos=$controlador->$metodo();
    
    if($controlador->mensaje!=null){ //Si hay mensaje de error / ejecución se visualiza SOLO si se ha cargado el mensaje. Si no ha cargado mensaje no se visualiza, ya que daría error en la vista
        $mensajeError = $controlador->mensaje;
    }else if(isset($_GET["mensaje"])){
        $mensajeError=$_GET["mensaje"];
    }

    if($controlador->vista != ''){
        require_once __DIR__ . "/vista/".$controlador->vista;
    }else{
        echo "No se ha podido cargar la vista";
    }
?>