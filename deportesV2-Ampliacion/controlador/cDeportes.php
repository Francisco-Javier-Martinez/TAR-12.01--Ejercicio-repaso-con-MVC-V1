<?php
    require_once __DIR__ .'/../modelo/mDeportes.php';
    //arhivo de rutas
    require_once __DIR__ .'/../config/configrt.php';
    class Cdeportes {
        private $modeloDeporte;
        public $vista;
        public $mensaje;
        
        //constructor 
        public function __construct() {
            $this->modeloDeporte=new Mdeportes();
            $this->vista='';
            $this->mensaje=null;
        }

        //metodo para mostrar la pantalla de inscripcion con los deportes
        public function pantallaInscri(){
            //coger los deportes disponibles
            $deportes=$this->modeloDeporte->obtenerDeportes();
            if(is_array($deportes)){//si es un arrray es que pillo los deportes bien
                $this->vista='inscripcion.php';
                return $deportes;
            }else{
                $this->mensaje=$deportes;
                $this->vista='aviso.php';
            }
        }

        //metodo para cargar la vista de deportes
        public function verDeportes(){
            $deportes=$this->modeloDeporte->obtenerDeportes();
            if(is_array($deportes)){//si es un arrray es que pillo los deportes bien
                $this->vista='deportes.php';
                return $deportes;
            }else{
                $this->mensaje=$deportes;
                $this->vista='aviso.php';
            }
        }

        

        //metodo para ver el total de deportes inscritos
        public function totalDeportesInscritos(){
            $total = $this->modeloDeporte->totalDeportesInscritos();
            if(is_array($total)){//si es un arrray es que pillo los deportes bien
                $this->vista='verTotalDeportes.php';
                return $total;
            }else{
                $this->mensaje=$total;
                $this->vista='falloDeportes.php';
            }
        }

        //metodo para monstrar el total de inscripciones por deporte
        public function totalInscripcionesPorDeporte(){
            $totalPorDeporte = $this->modeloDeporte->totalDeportesUsuarios();
            if(is_array($totalPorDeporte)){//si es un arrray es que pillo los deportes bien
                $this->vista='verTotalInscripcionesDeporte.php';
                return $totalPorDeporte;
            }else{
                $this->mensaje=$totalPorDeporte;
                $this->vista='falloDeportes.php';
            }
        }

        //metodo para eliminar un deporte
        public function eliminar(){
            $idDeporte = $_GET['id'];
            // Obtener la imagen del deporte para eliminar el archivo
            $imagen = $this->modeloDeporte->obtenerImagen($idDeporte);
            //si la imagen existe eliminamos el archivo
            if($imagen && !empty($imagen)){
                $rutaImagen = __DIR__ . '/../' . $imagen; //ruta completa de la imagen
                if(file_exists($rutaImagen)){ //si la imagen existe
                    unlink($rutaImagen);//unlink elimina el archivo
                }
            }
            // Eliminar el deporte de la BD
            $resultado = $this->modeloDeporte->eliminarDeporte($idDeporte);
            if($resultado === true){
                session_start();
                $this->mensaje = 'Deporte eliminado correctamente';
                $this->vista = 'panelAdmin.php';
            }else{
                $this->mensaje = $resultado;
                $this->vista = 'falloDeportes.php';
            }
        }

        //metodo para cargar la vista de anadir deportes
        public function crearDeporte(){
            $this->vista='anadirDeportes.php';
        }

        //metodo para guardar un deporte
        public function guardarDeporte(){
            //validar que el nombre del deporte no este vacio
            if(empty($_POST['nombreDep'])){
                $this->mensaje = 'El nombre del deporte es obligatorio';
                $this->vista = 'falloDeportes.php';
                return;
            }
            $imagenRuta='';
            //si se subio una imagen
            if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK){
                //guardar la imagen en la carpeta
                $resultado=$this->meterImagenCarpeta($_FILES['imagen']);
                if($resultado===false){
                    $this->vista='falloDeportes.php';
                    return;
                }else{
                    $imagenRuta=RUTA_IMAGENES_DEPORTES.$resultado; //concateno la ruta con el nombre de la imagen
                }
            }
            //guardar el deporte en la bd
            $resultadoGuardar=$this->modeloDeporte->guardarDeporte($imagenRuta);
            if($resultadoGuardar===true){
                session_start();
                $this->vista='panelAdmin.php';
            }else{
                $this->mensaje=$resultadoGuardar;
                $this->vista='falloDeportes.php';
            }
        }
        
        
        //meter img en la carpeta y guardar ruta en bd
        private function meterImagenCarpeta($file){
            try{
                if(!isset($file)){
                $this->mensaje = 'No se recibió el fichero de imagen';
                $this->vista = 'falloDeportes.php';
                return false;
                }
                if($file['error']!=UPLOAD_ERR_OK){
                    $this->mensaje = 'Error en la subida de la imagen)';
                    $this->vista = 'falloDeportes.php';
                    return false;
                }
                $extensionesPermitidas = ['png','jpg','jpeg'];
                //obtengo la extension del archivo subido
                //el pathinfo devuelve un array con informacion del archivo
                //y el PATHINFO_EXTENSION devuelve solo la extension
                $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                if(!in_array($extension, $extensionesPermitidas)){
                    $this->mensaje = 'Solo se permiten archivos .png, .jpg o .jpeg';
                    $this->vista = 'falloDeportes.php';
                    return false;
                }
                //el nombre de la imagen sera el nombreDeporte + la extension
                $nombreImagen = $_POST['nombreDep'] . '.' . $extension;
                //ruta carpeta donde se van a guardar las imagenes
                $rutaCarpeta = __DIR__ . '/../' . RUTA_IMAGENES_DEPORTES;
                //ruta destino es la ruta completa donde se va a guardar la imagen
                $rutaDestino = $rutaCarpeta . $nombreImagen;
                //si no se puede mover el archivo a la carpeta destino
                //devuelve false
                //el ['tmp_name'] es el nombre temporal que le da php al archivo subido
                if(!move_uploaded_file($file['tmp_name'], $rutaDestino)){
                    $this->mensaje = 'No se pudo mover la imagen al destino';
                    $this->vista = 'falloDeportes.php';
                    return false;
                }
                //si todo fue bien devuelve el nombre de la imagen
                return $nombreImagen;
            }catch (Exception $e){
                return "Error : ".$e->getMessage();
            }
        }
        //metodo para editar un deporte
        public function mostrarEditar(){
            $idDeporte = $_GET['id'];
            $deporte = $this->modeloDeporte->obtenerDeportePorId($idDeporte);
            if(!$deporte){
                $this->mensaje = 'Deporte no encontrado';
                $this->vista = 'falloDeportes.php';
                return;
            }
            $this->vista='monstrarEditar.php';
            return $deporte;
        }

        //metodo para guardar la edicion de un deporte
        public function guardarEdicion(){
            //recoger id deporte
            $idDeporte=$_GET['id'];
            //validar que el nombre del deporte no este vacio
            if(empty($_POST['nombreDep']) || !$idDeporte){
                $this->mensaje='Datos incompletos para actualizar';
                $this->vista='falloDeportes.php';
                return;
            }
            //obtenemos la imagen actual de la BD
            $imagenActual=$this->modeloDeporte->obtenerImagen($idDeporte);
            $imagenRuta=$imagenActual; 

            //si hay nueva imagen
            if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK){ //el upload_err_ok es que se subio bien
                //guardar la nueva imagen en la carpeta
                $resultado=$this->meterImagenCarpeta($_FILES['imagen']);
                if($resultado!==false){//si no hubo error al subir la imagen
                    $imagenRuta=RUTA_IMAGENES_DEPORTES . $resultado;
                    // Borrar la imagen antigua solo si es distinta a la nueva
                    if($imagenActual != $imagenRuta){
                        $rutaCompletaAntigua = __DIR__ . '/../' . $imagenActual;
                        if(file_exists($rutaCompletaAntigua)){
                            unlink($rutaCompletaAntigua);
                        }
                    }
                }
            }
            //actualizamos los datos del deporte en la bd con el nuevo nombre y la nueva imagen si hemos cambiado
            $resultadoGuardar=$this->modeloDeporte->actualizarDeporte($idDeporte, $imagenRuta);
            if($resultadoGuardar==true){//si se actualizo correctamente
                if (session_status() == PHP_SESSION_NONE){ //verificar si la sesion no esta iniciada
                    session_start(); 
                }
                $this->mensaje = 'Deporte actualizado correctamente';
                $this->vista = 'panelAdmin.php';
            } else {
                $this->mensaje = $resultadoGuardar;
                $this->vista = 'falloDeportes.php';
            }
        }
    }
?>