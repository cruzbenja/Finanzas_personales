<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location:../login.php");
} 
else {

    include("conexion.php");

    $tipo = $_GET["op"];

    if($tipo=="registrarIngreso"){

        $detalle = $_POST["Detalle"];
        $cantidad = $_POST["Cant"];
        $fecha = $_POST["Fecha"];
        $idUsuario = $_SESSION['id'];

                $insertar = "INSERT INTO ingresos VALUES(null,'$detalle',$cantidad,'$fecha',$idUsuario)";

                $resultado2 = mysqli_query($conectar, $insertar);

                if ($resultado2) {

                    echo '1';
                } 
                else {
                    echo '2';
                }
    }

    if($tipo=="EliminarIngreso"){

        $idIngreso = $_POST['Id'];
 
 
                 $insertar = "DELETE FROM ingresos where id =$idIngreso ";
 
                 $resultado2 = mysqli_query($conectar, $insertar);
 
                 if ($resultado2) {
 
                     echo '1';
                 } 
                 else {
                     echo '2';
                 }
    }

    if($tipo=="ModificarIngreso"){

        $Detalle = $_POST["Detalle1"];
        $cantidad = $_POST["Cantidad1"];
        $idIngreso = $_POST['Id1'];
 
 
                 $insertar = "UPDATE ingresos SET detalle='$Detalle', cantidad=$cantidad where id=$idIngreso ";
 
                 $resultado2 = mysqli_query($conectar, $insertar);
 
                 if ($resultado2) {
 
                     echo '1';
                 } 
                 else {
                     echo $insertar;
                 }
    }
}
?>