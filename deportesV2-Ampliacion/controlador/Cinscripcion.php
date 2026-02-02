<?php
    require_once __DIR__ .'/../modelo/mInscripcion.php';
    class Cinscripcion {
        private $modeloInscripcion;
        public $vista;
        public $mensaje;
        
        //constructor 
        public function __construct() {
            $this->modeloInscripcion=new Minscripcion();
            $this->vista='';
            $this->mensaje=null;
        }

        //metodo para registrar un nuevo usuario
        public function registrarUsuario(){
            if($_POST['username']=='' || $_POST['nombre_completo']=='' || $_POST['password']=='' || $_POST['email']==''){
                $this->mensaje="Error: Los campos obligatorios no pueden estar vacíos.";
                $this->vista='aviso.php';
            }else{
                if (!isset($_POST['deportes']) || empty($_POST['deportes'])) {
                    $this->mensaje = "Debes seleccionar al menos un deporte.";
                    $this->vista = 'aviso.php';
                    return;
                }
                //comprobar si se han aceptado las condiciones
                if(!isset($_POST['condiciones'])){
                    $this->mensaje="Error: Debes aceptar las condiciones.";
                    $this->vista='aviso.php';
                    return;
                }
                //si el telefono esta vacio, asignar valor null
                if(empty($_POST['telefono'])){
                    $_POST['telefono']=null;
                }
                //llamar al modelo para registrar el usuario
                $this->mensaje=$this->modeloInscripcion->registrarUsuario();
                //si el registro ha sido correcto, mostrar aviso de exito
                if($this->mensaje===true){//si  es true es que se ha registrado bien
                    $this->mensaje="Usuario registrado correctamente.";
                    $this->vista='aviso.php';
                    
                }else{
                    $this->vista='aviso.php';
                }
            }
        }


        //recoger las isncripciones de un usuario
        public function obtenerInscripciones(){
            $inscripciones = $this->modeloInscripcion->obtenerInscripciones();
            if(is_array($inscripciones)){//si es un arrray es que pillo los deportes bien
                $this->vista='verInscripciones.php';
                return $inscripciones;
            }else{
                $this->mensaje=$inscripciones;
                $this->vista='aviso.php';
            }
        }
    }
?>