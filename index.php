<?php
session_start();
require("Clases/conexion.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
} else {
    $usuario = $_SESSION['usuario'];
    $tipoUsuario = $_SESSION['idPersona'];
    $nombre = $_SESSION['nombre'];
    $apellidos = $_SESSION['apellidos'];
}


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Finanzas Personales</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script>setlocale(LC_ALL,"es_ES");</script>
</head>

<body class="sb-nav-fixed">

    <?php
    require_once "template/menu-configuracion.php";
    ?>
    <div id="layoutSidenav">
        <?php
        require_once "template/encabezado.php";
        ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tablero de Control</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Tarjetas informátivas</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body text-center"><h5><i class="bi bi-cash-coin"></i> Total Ingresos del Mes</h5></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                               
                                    <?php
                                    $mes = date('m');
                                    $consulta = "SELECT sum(cantidad) as cantidad from ingresos where month(fecha) = $mes;";
                                    $ejecutar = mysqli_query($conectar, $consulta) or die(mysqli_error($conectar));
                                    $row = $ejecutar->fetch_assoc();
                                    $cantidad = $row['cantidad'];
                                    ?>

                                    <p class="text-center">
                                    <label id = "IngresosMes"><h4>Bs. <?php if($cantidad == ""){echo '0';} else{echo $cantidad;}  ?></h4></label>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body text-center"><h5><i class="bi bi-cash-coin"></i> Total Gastos del Mes</h5></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                <?php
                                    $mes = date('m');
                                    $consulta = "SELECT sum(cantidad) as cantidad FROM gastosmesporcategoria where mesesnumero = $mes;";
                                    $ejecutar = mysqli_query($conectar, $consulta) or die(mysqli_error($conectar));
                                    $row = $ejecutar->fetch_assoc();
                                    $cantidad = $row['cantidad'];
                                    ?>
                                    
                                    <p class="text-center">
                                    <label id = "IngresosMes"><h4>Bs. <?php if($cantidad == ""){echo '0';} else{echo $cantidad;}  ?></h4></label>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-secondary text-white mb-4">
                                <div class="card-body text-center"><h5><i class="bi bi-cash-coin"></i> Ingreso Restante Mensual</h5></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                <?php
                                    //ingresos
                                    $mes = date('m');
                                    $consulta = "SELECT sum(cantidad) as cantidad from ingresos where month(fecha) = $mes;";
                                    $ejecutar = mysqli_query($conectar, $consulta) or die(mysqli_error($conectar));
                                    $row = $ejecutar->fetch_assoc();
                                    $ingreso = $row['cantidad'];

                                    //gastos
                                    $consulta = "SELECT sum(cantidad) as cantidad FROM gastosmesporcategoria where mesesnumero = $mes;";
                                    $ejecutar = mysqli_query($conectar, $consulta) or die(mysqli_error($conectar));
                                    $row = $ejecutar->fetch_assoc();
                                    $gastos = $row['cantidad'];

                                    $resultado = $ingreso - $gastos;
                                    ?>

                                    <p class="text-center">
                                    <label id = "IngresosMes"><h4>Bs. <?php echo $resultado;  ?></h4></label>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body text-center"><h5><i class="bi bi-cash-coin"></i> Total Ingresos Anuales</h5></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                <?php
                                    $año = date('Y');
                                    $consulta = "SELECT sum(cantidad) as cantidad from ingresos where year(fecha) = $año;";
                                    $ejecutar = mysqli_query($conectar, $consulta) or die(mysqli_error($conectar));
                                    $row = $ejecutar->fetch_assoc();
                                    $cantidad = $row['cantidad'];
                                    ?>

                                    <p class="text-center">
                                    <label id = "IngresosMes"><h4>Bs. <?php if($cantidad == ""){echo '0';} else{echo $cantidad;}  ?></h4></label>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body text-center"><h5><i class="bi bi-cash-coin"></i> Total Gastos Anuales</h5></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                <?php
                                    $año = date('Y');
                                    $consulta = "SELECT sum(cantidad) as cantidad FROM gastosmesporcategoria where año = $año;";
                                    $ejecutar = mysqli_query($conectar, $consulta) or die(mysqli_error($conectar));
                                    $row = $ejecutar->fetch_assoc();
                                    $cantidad = $row['cantidad'];
                                    ?>

                                    <p class="text-center">
                                    <label id = "IngresosMes"><h4>Bs.<?php if($cantidad == ""){echo '0';} else{echo $cantidad;}  ?></h4></label>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-secondary text-white mb-4">
                                <div class="card-body text-center"><h5><i class="bi bi-cash-coin"></i> Ingreso Restante Anual</h5></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                <?php
                                    //ingreso anual
                                    $año = date('Y');
                                    $consulta = "SELECT sum(cantidad) as cantidad from ingresos where year(fecha) = $año;";
                                    $ejecutar = mysqli_query($conectar, $consulta) or die(mysqli_error($conectar));
                                    $row = $ejecutar->fetch_assoc();
                                    $ingresoAnual = $row['cantidad'];

                                    //gasto anual
                                    $consulta = "SELECT sum(cantidad) as cantidad FROM gastosmesporcategoria where año = $año;";
                                    $ejecutar = mysqli_query($conectar, $consulta) or die(mysqli_error($conectar));
                                    $row = $ejecutar->fetch_assoc();
                                    $gastoAnual = $row['cantidad'];

                                    $resultadoAnual = $ingresoAnual - $gastoAnual;
                                    ?>

                                    <p class="text-center">
                                    <label id = "IngresosMes"><h4>Bs.<?php echo $resultadoAnual; ?></h4></label>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <?php $año = date('Y'); ?>
                        <div class="text-muted">Copyright &copy; Software Bolivia <?php echo $año ?></div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/datatables-simple-demo.js"></script>


   
</body>

</html>
