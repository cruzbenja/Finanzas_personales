<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location:../login.php");
} 
else {

        include("conexion.php");

        $tipo = $_GET["op"];

    if($tipo=="registrarGasto"){

        $categoria = $_POST["Categoria"];
        $nota = $_POST["Nota"];
        $cantidad = $_POST["Cant"];
        $fecha = $_POST["Fecha"];
        $idUsuario = $_SESSION['id'];


        //obtener el id de Categoria
        $sql = "select id,nombreCategoria from categoria where nombreCategoria ='$categoria'";
        $resultado = mysqli_query($conectar, $sql);
        $num = $resultado->num_rows;
        $row = $resultado->fetch_assoc();
        $idCategoria_bd = $row['id'];


                $insertar = "INSERT INTO gatos VALUES(null,'$nota','$idCategoria_bd',$cantidad,'$fecha',$idUsuario)";

                $resultado2 = mysqli_query($conectar, $insertar);

                if ($resultado2) {

                    echo '1';
                } 
                else {
                    echo '2';
                }
    }

    if($tipo=="ModificarGasto"){

        $categoria = $_POST["Categoria1"];
        $nota = $_POST["Nota1"];
        $cantidad = $_POST["Cantidad1"];
        $idGasto = $_POST['Id1'];

         //obtener el id de Categoria
         $sql = "select id,nombreCategoria from categoria where nombreCategoria ='$categoria'";
         $resultado = mysqli_query($conectar, $sql);
         $num = $resultado->num_rows;
         $row = $resultado->fetch_assoc();
         $idCategoria_bd = $row['id'];
 
 
                 $insertar = "UPDATE gatos SET nota='$nota',cantidad=$cantidad,idCategoria='$idCategoria_bd' where id=$idGasto ";
 
                 $resultado2 = mysqli_query($conectar, $insertar);
 
                 if ($resultado2) {
 
                     echo '1';
                 } 
                 else {
                     echo '2';
                 }
    }

    if($tipo=="EliminarGasto"){

        $idGasto = $_POST['Id'];

        $insertar = "DELETE FROM gatos where id=$idGasto";
 
        $resultado2 = mysqli_query($conectar, $insertar);

        if ($resultado2) {

            echo '1';
        } 
        else {
            echo '2';
        }
    }


}
?>