<?php
session_start();
require("Clases/conexion.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
} else {
    $usuario = $_SESSION['usuario'];
    $idPersona = $_SESSION['idPersona'];
    $idUsuario =  $_SESSION['id'];
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
    <title>Configuración Datos Personales</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body class="sb-nav-fixed" onload="obtenerDatos()">

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
                    <h2 class="mt-4">Datos Personales</h2>
                    <form class="row g-3" style="padding-top:20px;" id="datosPersona">

                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar nombre">
                        </div>
                        <div class="col-md-6">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" placeholder="Ingresar apellidos">
                        </div>
                        <div class="col-md-4">
                            <label for="carnet" class="form-label">Carnet</label>
                            <input type="text" class="form-control" id="carnet" placeholder="Ingresar de carnet ">
                        </div>
                        <div class="row" style="padding-top:20px;">
                            <h3 class="mt-4">Datos del Usuario</h3>
                            <div class="col-md-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="usuario" placeholder="Ingresar nombre de usuario ">
                            </div>
                            <div class="col-md-3">
                                <label for="contra" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="contra" disabled placeholder="Ingresar contraseña actual">
                            </div>
                            <div class="col-md-3">
                                <label for="contra" class="form-label">Contraseña Actual</label>
                                <input type="password" class="form-control" name="Actualcontra" id="Actualcontra" placeholder="Ingresar contraseña actual">
                            </div>
                            <div class="col-md-3">
                                <label for="newContra" class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" name="Nuevacontra" id="Nuevacontra" placeholder="Ingresar nueva contraseña">
                            </div>
                        </div>


                        <div class="col-12" style="padding-top:20px;">
                            <button type="button" class="btn btn-primary" onclick="ActualizarDatos()">Actualizar</button>
                        </div>
                    </form>

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

    <!--funcion Actualizar categoria-->
    <script>
        function ActualizarDatos(idPersona, idUsuario) {

            var nombre = $('#nombre').val();
            var apellidos = $('#apellidos').val();
            var carnet = $('#carnet').val();
            var usuario = $('#usuario').val();
            var contra = $('#contra').val();
            var Nuevacontra = $('#Nuevacontra').val();
            var Actualcontra = $('#Actualcontra').val();



            if (nombre == "" || apellidos == "" || carnet == "") {
                swal.fire("Campos Vacios..!", "Debe ingresar el nombre de la categoria", "warning");
                return false;
            }

            if (Nuevacontra != "" && Actualcontra != "") {
                if (Actualcontra != contra) {
                    swal.fire("Incorrecto..!", "No has ingresado correctamente tu contraseña actual", "warning");
                    return false;
                }
            }

            $.ajax({
                url: 'Clases/Cl_DatosPersona.php?op=ActualizarDatos',
                type: 'POST',
                data: {
                    nomb: nombre,
                    ape: apellidos,
                    ci: carnet,
                    user: usuario,
                    Contra: contra,
                    newContra: Nuevacontra,
                    ActuContra: Actualcontra
                },
                error: function(vs){
                    swal.fire("Error..!", vs, "error");
                },
                success: function(vs) {
                    if (vs == 1) {
                        swal.fire("Exito..!", "Datos Personales y Datos del Usuario Actualizado correctamente", "success");
                        $('#Nuevacontra').val("");
                        $('#Actualcontra').val("");
                    } else {
                        if (vs == 2) {
                            swal.fire("Exito..!", "Datos del Usuario Actualizado correctamente", "success");
                            $('#Nuevacontra').val("");
                            $('#Actualcontra').val("");
                        } else {
                            if (vs == 3) {
                                swal.fire("Exito..!", "Datos Personales Actualizado correctamente", "success");
                                $('#Nuevacontra').val("");
                                $('#Actualcontra').val("");
                            } else {
                                if (vs == 3) {
                                    swal.fire("Error..!", "Ha ocurrido un error con la base de datos", "warning");
                                }
                            }
                        }
                    }
                }

            })
        }




   // obtener los datos de la bd y pasarlo al formulario

        function obtenerDatos() {

            $.ajax({
                dataType: 'json',
                url: 'Clases/Cl_DatosPersona.php?op=obtenerDatos',
                type: 'POST',

                success: function(Arreglo) {
                    $('#nombre').val(Arreglo.nombre);
                    $('#apellidos').val(Arreglo.apellidos);
                    $('#carnet').val(Arreglo.carnet);
                    $('#usuario').val(Arreglo.usuario);
                    $('#contra').val(Arreglo.contra);
                    $('#Actualcontra').val("");
                    $('#Nuevacontra').val("");
                }
            })
        }
    </script>
</body>

</html>