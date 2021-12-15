<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location:../login.php");
} 
else {

    include("conexion.php");

    $idPersona = $_SESSION['idPersona'];
    $idUsuario = $_SESSION['id'];
$tipo = $_GET["op"];


if($tipo == "obtenerDatos"){

    

        $insertar = "select p.nombre,p.apellidos,p.carnet,u.usuario,u.contra from Persona as p inner JOIN usuario as u on u.idPersona = p.id where idPersona = $idPersona;";

        $resultado = mysqli_query($conectar, $insertar);

        if ($resultado) {
            
            while ($listado = mysqli_fetch_array($resultado)) {
                $Arreglo['nombre'] = $listado['nombre'];
                $Arreglo['apellidos'] = $listado['apellidos'];               
                $Arreglo['carnet'] = $listado['carnet'];
                $Arreglo['usuario'] = $listado['usuario'];
                $Arreglo['contra'] = $listado['contra'];
            }
            $Arreglo = $Arreglo;
            echo json_encode($Arreglo);
        } else {
            echo 'error';
        }
    }

    if($tipo == "ActualizarDatos"){     

        $resultado2 = false;
        $nombre = $_POST['nomb'];
        $apellidos = $_POST['ape'];
        $carnet = $_POST['ci'];
        $usuario = $_POST['user'];
        $contra = $_POST['Contra'];
        $NuevaContra = $_POST['newContra'];
        $ActualContra = $_POST['ActuContra'];


                 $insertar = "UPDATE persona SET nombre='$nombre', apellidos='$apellidos', carnet ='$carnet'  where id=$idPersona ";
 
                 $resultado = mysqli_query($conectar, $insertar);
 
                 if($NuevaContra != ""){
                    $Actualizar = "UPDATE usuario SET usuario='$usuario', contra='$NuevaContra' where id=$idUsuario ";

                    $resultado2 = mysqli_query($conectar, $Actualizar);
                 }

                 if ($resultado2 && $resultado) {
                     echo '1';
                 } 
                 else {
                    if ($resultado2) {
                        echo '2';
                    } 
                    if ($resultado) {
                        echo '3';
                    } 
                    else{
                        echo '4';
                    }
                     
                 }
            
    }

}
?>