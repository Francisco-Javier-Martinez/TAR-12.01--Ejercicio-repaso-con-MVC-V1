<?php
    require_once __DIR__ . '/conexion.php';
    class Musuarios extends Conexion{
        //metodo para meter administrador
        public function crearAdmin($nombreUsuario,$nombreCompleo, $password,$correo,$perfil){
            try{
                //preparar la consulta
                $sql="INSERT INTO Usuarios (nombreUsuario, apeNombre, password, correo, perfil) VALUES (:nombreUsuario, :apeNombre, :password, :correo, :perfil)";
                $stmt=$this->conexion->prepare($sql);
                //vincular los parametros
                $stmt->bindParam(':nombreUsuario', $nombreUsuario);
                $stmt->bindParam(':apeNombre',$nombreCompleo);
                $stmt->bindParam(':password',$password);
                $stmt->bindParam(':correo',$correo);
                $stmt->bindParam(':perfil',$perfil);
                //ejecutar la consulta
                $stmt->execute();
                return "Administrador creado correctamente";
            }catch (PDOException $e){
                return "Error : ".$e->getMessage();
            }
        }
        //metodo para comprobar que sea administrador
        public function validarUsuario(){
            //recoger los datos del formulario
            $nombreUsuario=$_POST['nombre'];
            try{
                //preparar la consulta
                $sql="SELECT * FROM Usuarios WHERE nombreUsuario=:nombreUsuario AND perfil='c'";
                $stmt=$this->conexion->prepare($sql);
                //vincular los parametros
                $stmt->bindParam(':nombreUsuario', $nombreUsuario);
                //ejecutar la consulta
                $stmt->execute();
                if($stmt->rowCount()>0){
                    $contenido = $stmt->fetch(PDO::FETCH_ASSOC);
                    //retornos los datos 
                    return $contenido;
                }else{
                    return false;
                }
        }catch (PDOException $e){
                return "Error : ".$e->getMessage();
            }
        }
    }
?>