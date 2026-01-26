<?php
    require_once __DIR__ .'/../modelo/conexion.php';
    class Musuarios extends Conexion{
        
        //metodo para comprobar que sea administrador
        public function validarUsuario(){
            //recoger los datos del formulario
            $nombreUsuario=$_POST['nombre'];
            $password=$_POST['password'];
            try{
                //preparar la consulta
                $sql="SELECT * FROM Usuarios WHERE nombreUsuario=:nombreUsuario AND password=:password AND perfil='c'";
                $stmt=$this->conexion->prepare($sql);
                //vincular los parametros
                $stmt->bindParam(':nombreUsuario', $nombreUsuario);
                $stmt->bindParam(':password',$password);
                //ejecutar la consulta
                $stmt->execute();
                if($stmt->rowCount()>0){
                    //si es correcto saco el id del usuario para guardarlo en sesion
                    $SacarId = $stmt->fetch(PDO::FETCH_ASSOC);
                    //si es correcto retorno true y inicio sesion
                    session_start();
                    $_SESSION['nombreUsuario']=$nombreUsuario;
                    $_SESSION['id'] =$SacarId['idUsuario'];
                    return true;
                }else{
                    return false;
                }
        }catch (PDOException $e){
                return "Error : ".$e->getMessage();
            }
        }
    }
?>