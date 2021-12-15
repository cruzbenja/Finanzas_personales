<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location:../login.php");
} 
else {

    include("conexion.php");
$tipo = $_GET["op"];


if($tipo == "GastoMensual"){
        $condicion = "";

            $ano = $_POST["ano"];

            if($ano != ""){
                $condicion = "where año = $ano";
            }
                    $insertar = "SELECT mes,sum(cantidad) as cantidad from gastosmesporcategoria $condicion group by mes order by mesesnumero asc;";

                    $resultado = mysqli_query($conectar, $insertar);

                    if ($resultado) {
                        while ($listado = mysqli_fetch_array($resultado)) {
                            $Arreglo[] = $listado;
                        }
                        $lista = $Arreglo;
                        echo json_encode($lista);
                    } 
                    else {
                        echo 'error';
                    }
    }


if($tipo == "GastoMensualCategoria"){
            $condicion = "";

                $ano = $_POST["ano"];
                $mes = $_POST["mes"];
    
                if($mes == 'Enero'){
                    $mes = 1;
                }else{
                    if($mes == 'Febrero'){
                        $mes = 2;
                    }else{
                        if($mes == 'Marzo'){
                            $mes = 3;
                        }else{
                            if($mes == 'Abril'){
                                $mes = 4;
                            }
                            else{
                                if($mes == 'Mayo'){
                                    $mes = 5;
                                }else{
                                    if($mes == 'Junio'){
                                        $mes=6;
                                    } if($mes == 'Julio'){
                                        $mes = 7;
                                    }else{
                                        if($mes == 'Agosto'){
                                            $mes = 8;
                                        }else{
                                            if($mes == 'Septiembre'){
                                                $mes = 9;
                                            }else{
                                                if($mes == 'Octubre'){
                                                    $mes = 10;
                                                }
                                                else{
                                                    if($mes == 'Noviembre'){
                                                        $mes = 11;
                                                    }else{
                                                        if($mes == 'Diciembre'){
                                                            $mes= 12;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if($ano != ""){
                    $condicion = "where año = $ano and mesesnumero= $mes";
                }    
                    
                        $insertar = "SELECT nombreCategoria,sum(cantidad) as cantidad from gastosmesporcategoria $condicion group by nombreCategoria;";
                       
                        $resultado1 = mysqli_query($conectar, $insertar);
                       
                         if ($resultado1) {
                           while ($listado = mysqli_fetch_array($resultado1)) {
                                $Arreglo[] = $listado;
                            }
                            $lista = $Arreglo;
                            echo json_encode($lista);
                           
                        } 
                        else {
                            echo 'error';
                        }
            }

if($tipo == "IngresoMensual"){


        $condicion = "";
        
            $ano = $_POST["ano"];

        if ($ano != "") {
            $condicion = "where year(fecha) = $ano";
        }
        $insertar = "SELECT elt(month(fecha),'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre') as meses,
         sum(cantidad) as cantidad FROM ingresos $condicion GROUP by meses order by month(fecha) asc;";

        $resultado = mysqli_query($conectar, $insertar);

        if ($resultado) {
            while ($listado = mysqli_fetch_array($resultado)) {
                $Arreglo[] = $listado;
            }
            $lista = $Arreglo;
            echo json_encode($lista);
        } else {
            echo 'error';
        }
    }            
}
?>