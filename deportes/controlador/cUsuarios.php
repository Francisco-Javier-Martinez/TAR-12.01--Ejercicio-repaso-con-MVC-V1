<?php
    require_once __DIR__ .'/../modelo/mUsuarios.php';
    class Cusuarios {
        private $modeloUsuarios;
        public $vista;
        public $mensaje;
        
        //constructor 
        public function __construct() {
            $this->modeloUsuarios=new Musuarios();
            $this->vista='';
            $this->mensaje=null;
        }

        //metodo para mostrar la pantalla de inicio de sesion
        public function pantallaInicio(){
            $this->vista='seleccion.html';
        }
        
        //metodo para mostrar la pantalla de inicio de sesion
        public function pantallaRegistro(){
            $this->vista='inicioSesion.php';
        }

        //metodo para volver al panel de administracion
        public function volverPanelAdmin(){
            session_start();    
        $this->vista='panelAdmin.php';
        }
        
        //metodo para el inicio de sesion
        public function iniciarSesion(){
            if($_POST['nombre']=='' || $_POST['password']==''){
                $this->mensaje="Error: Los campos no pueden estar vacíos.";
                $this->vista='aviso.php';
                return;
            }

            $this->mensaje=$this->modeloUsuarios->validarUsuario();
            if(is_array($this->mensaje)){
                //usamos el password verify para comprobar la contraseña
                if(password_verify($_POST['password'], $this->mensaje['password'])){
                    session_start();
                    $_SESSION['nombreUsuario']=$this->mensaje['nombreUsuario'];
                    $_SESSION['idUsuario']=$this->mensaje['idUsuario'];
                    $_SESSION['perfil']=$this->mensaje['perfil'];
                    $this->mensaje="Inicio de sesión correcto.";
                    $this->vista='panelAdmin.php';
                }else{
                    $this->mensaje="Error: Contraseña incorrecta.";
                    $this->vista='aviso.php';
                }
            }else{
                $this->mensaje="Error: no tienes acceso de administrador.";
                $this->vista='aviso.php';
            }
        }

        
        //metodo para cerrar sesion
        public function cerrarSesion(){
            session_start();
            session_unset();//elimino variables de sesion
            session_destroy();//y destruyo la sesion
            $this->vista='seleccion.html';
        }

    }
?>