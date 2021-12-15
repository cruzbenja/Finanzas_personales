<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location:../login.php");
} 
else {

    include("conexion.php");

    $tipo = $_GET["op"];

    if($tipo=="registrarCategoria"){

            $nombre = $_POST["nombre"];
            $estado = "Activo";


            if($nombre  == ""){
                echo '1';
                return false;
            }

            $consulta = "SELECT * FROM categoria WHERE nombreCategoria = '$nombre'";
            $validar = mysqli_query($conectar, $consulta);
            if (mysqli_num_rows($validar) > 0) {
                echo '2';   
            } 
            else {
                    $insertar = "INSERT INTO categoria VALUES(null,'$nombre','$estado')";

                    $resultado2 = mysqli_query($conectar, $insertar);

                    if ($resultado2) {

                        echo '3';
                    } 
                    else {
                        echo '4';
                    }
                }
    }


    if($tipo=="ModificarCategoria"){

        $categoria = $_POST["Categoria1"];
        $idCate = $_POST['Id1'];
 
        if($categoria == ""){
            echo '3';
            return false;
        }
                 $insertar = "UPDATE categoria SET nombreCategoria='$categoria' where id=$idCate ";
 
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