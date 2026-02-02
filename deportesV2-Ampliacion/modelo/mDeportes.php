<?php
    require_once __DIR__ .'/../modelo/conexion.php';
    class Mdeportes extends Conexion{
        //sacar los deportes disponibles
        public function obtenerDeportes(){
            try{
                $sql="SELECT * FROM Deportes";
                $stmt=$this->conexion->prepare($sql);
                $stmt->execute();
                $deportes=$stmt->fetchAll(PDO::FETCH_ASSOC);
                return $deportes;
            }catch (PDOException $e){
                return "Error : ".$e->getMessage();
            }
        }

        
        //metodo para ver el total de deportes inscritos
        public function totalDeportesInscritos(){
            try{
                $sql="SELECT COUNT(DISTINCT idDeporte) as TotalDeporte
                        FROM Usuarios_deportes;";
                $stmt=$this->conexion->prepare($sql);
                $stmt->execute();
                $total=$stmt->fetch(PDO::FETCH_ASSOC);
                return $total;;
                }catch (PDOException $e){
                    return "Error : ".$e->getMessage();
            }
        }
        //metodo para ver el total de deportes inscritos por usuario
        public function totalDeportesUsuarios(){
            try{
                $sql="SELECT Deportes.nombreDep,COUNT(Usuarios_deportes.idDeporte) as Total_Gente_Inscrita
	        FROM Deportes 
    	inner join Usuarios_deportes on Deportes.idDeporte=Usuarios_deportes.idDeporte
        GROUP BY Deportes.idDeporte;";
                $stmt=$this->conexion->prepare($sql);
                $stmt->execute();
                $totalUsuarios=$stmt->fetchAll(PDO::FETCH_ASSOC);
                return $totalUsuarios;
                }catch (PDOException $e){
                    return "Error : ".$e->getMessage();
                }
        }
        //metodo para obtener la imagen de un deporte
        public function obtenerImagen($idDeporte){
            try{
                $sql="SELECT imagen FROM Deportes WHERE idDeporte=:idDeporte";
                $stmt=$this->conexion->prepare($sql);
                $stmt->bindParam(':idDeporte',$idDeporte);
                $stmt->execute();
                $deporte = $stmt->fetch(PDO::FETCH_ASSOC);
                return $deporte['imagen'];
            }catch (PDOException $e){
                return "Error : ".$e->getMessage();
            }
        }

        //metodo para eliminar un deporte
        public function eliminarDeporte($idDeporte){
            try{
                $sql="DELETE FROM Deportes WHERE idDeporte=:idDeporte";
                $stmt=$this->conexion->prepare($sql);
                $stmt->bindParam(':idDeporte',$idDeporte);
                $stmt->execute();
                return true;
            }catch (PDOException $e){
                return "Error : ".$e->getMessage();
            }
        }

        //metodo para guardar un deporte
        public function guardarDeporte($imagen){
            if($imagen==''){
                $imagen=null;
            }
            //recoger el nombre
            $nombreDep=$_POST['nombreDep'];
            try{
                $sql="INSERT INTO Deportes (nombreDep,imagen) VALUES (:nombreDep,:imagen)";
                $stmt=$this->conexion->prepare($sql);
                $stmt->bindParam(':nombreDep',$nombreDep);
                $stmt->bindParam(':imagen',$imagen);
                $stmt->execute();
                return true;
            }catch (PDOException $e){
                return "Error : ".$e->getMessage();
            }
        }

        //metodo para obtener un deporte por id
        public function obtenerDeportePorId($idDeporte){
            try{
                $sql="SELECT * FROM Deportes WHERE idDeporte=:idDeporte";
                $stmt=$this->conexion->prepare($sql);
                $stmt->bindParam(':idDeporte',$idDeporte);
                $stmt->execute();
                $deporte = $stmt->fetch(PDO::FETCH_ASSOC);
                return $deporte;
            }catch (PDOException $e){
                return "Error : ".$e->getMessage();
            }
        }

        //metodo para guardar la edicion de un deporte
        public function actualizarDeporte($idDeporte,$imagen){
            //regoger el nombre
            $nombreDep=$_POST['nombreDep'];
            try{
                $sql="UPDATE Deportes SET nombreDep=:nombreDep, imagen=:imagen WHERE idDeporte=:idDeporte";
                $stmt=$this->conexion->prepare($sql);
                $stmt->bindParam(':imagen',$imagen);
                $stmt->bindParam(':nombreDep',$nombreDep);
                $stmt->bindParam(':idDeporte',$idDeporte);
                $stmt->execute();
                return true;
            }catch (PDOException $e){
                return "Error : ".$e->getMessage();
            }
        }

    }
?>