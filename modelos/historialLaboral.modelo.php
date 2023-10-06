 <?php

 require_once "conexion.php";


class ModeloHistoriales{


/*=============================================
    MOSTRAR HISTORIAL LABORAL
 =============================================*/

    static public function mdlMostrarHistorial($tabla, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        $stmt -> close();

        $stmt = null;

        }

/*=============================================
  MOSTRAR HISTORIAL LABORAL POR ID    
  =============================================*/

        public static function mdlMostrarHistorialPorId($tabla, $item, $valor) {
        if ($item != null && $valor != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

       /*=============================================
    CREAR UN NUEVO REGISTRO EN EL HISTORIAL LABORAL
    =============================================*/

    static public function mdlIngresarHistorial($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (idEmpleado, fechaIngreso, fechaSalida, departamento, cargo, salario) VALUES (:idEmpleado, :fechaIngreso, :fechaSalida, :departamento, :cargo, :salario)");

            $stmt->bindParam(":idEmpleado", $datos["idEmpleado"], PDO::PARAM_INT);
            $stmt->bindParam(":fechaIngreso", $datos["fechaIngreso"], PDO::PARAM_STR);
            $stmt->bindParam(":fechaSalida", $datos["fechaSalida"], PDO::PARAM_STR);
            $stmt->bindParam(":departamento", $datos["departamento"], PDO::PARAM_STR);
            $stmt->bindParam(":cargo", $datos["cargo"], PDO::PARAM_STR);
            $stmt->bindParam(":salario", $datos["salario"], PDO::PARAM_STR);
           
           
           if($stmt->execute()){

            return "ok";

        }else{

            return "error";
        
        }

        $stmt->close();
        $stmt = null;

    }
}

  