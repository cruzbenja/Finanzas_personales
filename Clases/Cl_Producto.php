<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location:../login.php");
} 
else {

    include("conexion.php");

    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];
    $stock = $_POST["stock"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $ubicacion = $_POST["ubicacion"];
    $almacen = $_POST["almacen"];
    $categoria = $_POST["categoria"];
    $marca = $_POST["marca"];
    $estado = "Activo";


    if($codigo == "" || $nombre  == "" || $stock == "" || $descripcion == "" ||$precio == "" || $ubicacion == "" || $almacen == ""){
        echo '1';
        return false;
    }

    $consulta = "SELECT * FROM productos WHERE Codigo = '$codigo'";
    $validar = mysqli_query($conectar, $consulta);
    if (mysqli_num_rows($validar) > 0) {
        echo '2';
      
    } 
    else {

        $consulta1 = "SELECT * FROM productos WHERE nombre = '$nombre'";
        $validar1 = mysqli_query($conectar, $consulta1);
        if (mysqli_num_rows($validar1) > 0) {
            echo '3';
         
        } 
        else {

            //obtener el id de Categoria
            $sql = "select id,categoria from categoria where categoria ='$categoria'";
            $resultado = mysqli_query($conectar, $sql);
            $num = $resultado->num_rows;
            $row = $resultado->fetch_assoc();
            $idCategoria_bd = $row['id'];

            //obtener el id de marca
            $sql1 = "select id,marca from marca where marca ='$marca'";
            $resultado1 = mysqli_query($conectar, $sql1);
            $num1 = $resultado1->num_rows;
            $row1 = $resultado1->fetch_assoc();
            $idmarca_bd = $row1['id'];

            $insertar = "INSERT INTO productos VALUES('$codigo','$nombre','$stock','$descripcion','$precio','$ubicacion','$almacen','$idCategoria_bd','$idmarca_bd','$estado')";

            $resultado2 = mysqli_query($conectar, $insertar);

            if ($resultado2) {

                echo '4';
            } 
            else {
                echo '5';
            }
        }
    }
}
?>