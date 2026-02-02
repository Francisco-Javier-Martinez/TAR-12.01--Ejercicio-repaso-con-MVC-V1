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

        //metodo para mostrar la pantalla de inscripcion
        public function pantallaInscri(){
            //coger los deportes disponibles
            $deportes=$this->modeloInscripcion->obtenerDeportes();
            if(is_array($deportes)){//si es un arrray es que pillo los deportes bien
                $this->vista='inscripcion.php';
                return $deportes;
            }else{
                $this->mensaje=$deportes;
                $this->vista='aviso.php';
            }
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

        //metodo para ver el total de deportes inscritos
        public function totalDeportesInscritos(){
            $total = $this->modeloInscripcion->totalDeportesInscritos();
            if(is_array($total)){//si es un arrray es que pillo los deportes bien
                $this->vista='verTotalDeportes.php';
                return $total;
            }else{
                $this->mensaje=$total;
                $this->vista='aviso.php';
            }
        }

        //metodo para monstrar el total de inscripciones por deporte
        public function totalInscripcionesPorDeporte(){
            $totalPorDeporte = $this->modeloInscripcion->totalDeportesUsuarios();
            if(is_array($totalPorDeporte)){//si es un arrray es que pillo los deportes bien
                $this->vista='verTotalInscripcionesDeporte.php';
                return $totalPorDeporte;
            }else{
                $this->mensaje=$totalPorDeporte;
                $this->vista='aviso.php';
            }
        }
    }
?>