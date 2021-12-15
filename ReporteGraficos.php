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
    <title>Reportes - Gráficos</title>
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
                    <h1 class="mt-4">Reportes - Gráficos</h1>
                   
                    <div class="row" style="padding-top:20px">
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header text-white bg-primary">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Gastos por meses
                                </div>
                                <form class="row g-3" style="padding-Top:20px; padding-left :15px;">

                                    <div class="col-auto">
                                        
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Seleccionar Año">
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" class="form-control" id="ano" placeholder="Año">
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary mb-3" onclick="TraerdatosBD()">Filtrar</button>
                                    </div>
                                </form>
                                <div class="card-body"><canvas id="myChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header text-white bg-primary">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Gastos por Categoria por Mes
                                </div>
                                <form class="row g-3" style="padding-Top:20px; padding-left :15px;">
                                    <div class="col-auto">
                                        
                                        <input type="text" readonly class="form-control-plaintext" value="Seleccionar Mes y Año">
                                    </div>
                                    <div class="col-auto">
                                        <select name="mes" id="mes" class="form-select">seleccionar Mes
                                           <option>Enero</option>
                                           <option>Febrero</option>
                                           <option>Marzo</option>
                                           <option>Abril</option>
                                           <option>Mayo</option>
                                           <option>Junio</option>
                                           <option>Julio</option>
                                           <option>Agosto</option>
                                           <option>Septiembre</option>
                                           <option>Octubre</option>
                                           <option>Noviembre</option>
                                           <option>Diciembre</option>
                                        </select>                                      
                                    </div>
                                    <div class="col-auto">                                    
                                        <input type="text" class="form-control" id="anos" placeholder="Año">                                    
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary mb-3" onclick="TraerGastosCategoria()">Filtrar</button>
                                    </div>
                                    </form>
                                <div class="card-body"><canvas id="myChart2" width="100%" height="55"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header text-white bg-primary">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Ingresos por meses
                                </div>
                                <form class="row g-3" style="padding-Top:20px; padding-left :15px;">

                                    <div class="col-auto">                                      
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Seleccionar Año">
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" class="form-control" id="ano1" placeholder="Año">
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary mb-3" onclick="TraerdatosIngresosBD()">Filtrar</button>
                                    </div>
                                </form>
                                <div class="card-body"><canvas id="myChart3" width="100%" height="40"></canvas></div>
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


    <script>
        function TraerGastosCategoria() {

            var Ano = $('#anos').val();
            var Mes = $('#mes').val();

            if (Ano == "") {
                    return swal.fire("Ops..!", "Debes ingresar el año", "warning");
                }

            $.ajax({
            url:'Clases/Cl_DatosGrafica.php?op=GastoMensualCategoria',
            type:'POST',
            data:{
                ano: Ano,
                mes: Mes
            },
            success:function (resp) {
                var titulo= [];
                var cantidad = [];
                var data= JSON.parse(resp);
                for(var i=0;i< data.length;i++){
                    titulo.push(data[i][0]);
                    cantidad.push(data[i][1]);
                }
                CrearGraficos(titulo,cantidad,'Gasto por Categorias','bar','myChart2');
                    }
                })
        }
    </script>


    <script>
        function TraerdatosBD() {

            var Ano = $('#ano').val();

        if (Ano == "") {
            return swal.fire("Ops..!", "Debes ingresar el año", "warning");
        }
            $.ajax({
                url:'Clases/Cl_DatosGrafica.php?op=GastoMensual',
                type:'POST',
                data:{
                    ano: Ano
                },
                success:function (resp) {
                    var titulo= [];
                    var cantidad = [];
                    var data= JSON.parse(resp);
                    for(var i=0;i< data.length;i++){
                        titulo.push(data[i][0]);
                        cantidad.push(data[i][1]);
                    }
                    CrearGraficos(titulo,cantidad,'Gasto por mes','line','myChart');
                }
            })    
    }
    </script>


    <script>
        function TraerdatosIngresosBD() {

            var Ano = $('#ano1').val();

        if (Ano == "") {
            return swal.fire("Ops..!", "Debes ingresar el año", "warning");
        }
            $.ajax({
                url:'Clases/Cl_DatosGrafica.php?op=IngresoMensual',
                type:'POST',
                data:{
                    ano: Ano
                },
                success:function (resp) {
                    var titulo= [];
                    var cantidad = [];
                    var data= JSON.parse(resp);
                    for(var i=0;i< data.length;i++){
                        titulo.push(data[i][0]);
                        cantidad.push(data[i][1]);
                    }
                    CrearGraficos(titulo,cantidad,'Ingreso por mes','line','myChart3');
                }
            })    
        }
    </script>


    <script>
        function CrearGraficos(titulo,cantidad,encabezado,tipo,id) {
            const ctx = document.getElementById(id);
            const myChart = new Chart(ctx, {
                type: tipo,
                data: {
                    labels: titulo,
                    datasets: [{
                        label: encabezado,
                        data: cantidad,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            })
        }
    </script>
</body>

</html>
