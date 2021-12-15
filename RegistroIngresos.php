<?php
session_start();
include 'Clases/conexion.php';
require("Clases/conexion.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
} else {
    $id = $_SESSION['id'];
    $usuario = $_SESSION['usuario'];
    $tipoUsuario = $_SESSION['idPersona'];
    $nombre = $_SESSION['nombre'];
    $apellidos = $_SESSION['apellidos'];
}



$sql = "select * from ingresos where idUsuario = $id";

$resultado = mysqli_query($conectar, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Ingresos</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                    <h1 class="mt-4">Ingresos</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Escritorio</a></li>
                        <li class="breadcrumb-item active">Ingresos</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-circle"></i> Nuevo Ingreso</a>

                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-secondary table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Detalle Ingreso</th>
                                        <th>Cantidad</th>
                                        <th>Fecha</th>
                                        <th width=200px>Acción</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $cont = 0;
                                    while ($row = $resultado->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['detalle']; ?></td>
                                            <td><?php echo $row['cantidad']; ?></td>
                                            <td><?php echo $row['fecha']; ?></td>
                                            <td><button type='button' class='btn btn-success btn-sm checkbox-toggle' onclick="editarIngresoModal('<?php echo $row['id']; ?>','<?php echo $row['detalle']; ?>','<?php echo $row['cantidad']; ?>')"><i title="Editar" class="bi bi-pencil"></i> Editar</button>
                                                <button type='button' class='btn btn-danger btn-sm checkbox-toggle' onclick="ConfirmarModificarIngreso('<?php echo $row['id']; ?>')"><i title="Eliminar" class="bi bi-x-circle"></i> Eliminar</button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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


     <!--funcion Actualizar Ingreso-->
     <script>
        function ModificarIngreso(){

            var Id = $('#id1').val();
            var Detalle = $('#Detalle1').val();
            var Cantidad = $('#Cantidad1').val();
           
            $.ajax({
                url: 'Clases/Cl_Ingresos.php?op=ModificarIngreso',
                type:'POST',
                data:{
                    Id1:Id,
                    Detalle1: Detalle,
                    Cantidad1: Cantidad                 
                },
                success: function(vs) {
                    if(vs == 1){
                        MostrarAlerta("Exito..!", "Actualizado correctamente", "success");
                        $('#datatablesSimple').load('RegistroIngresos.php #datatablesSimple')
                        $('#ModalEditarIngreso').modal('hide');
                    }
                    else{
                        Swal.fire("Ops..!", vs, "error");
                    }
                }
            })
        }
    </script>



    <!-- Modal Registrar Ingreso-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-file-text"></i> <b>Nuevo Ingreso</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="formRegistroProductos" class="row g-3 needs-validation" novalidate>
                        <div class="col-md-12">
                            <label for="inputCodigo" class="form-label"><b>Detalle</b></label>
                            <input type="text" class="form-control" name="Detalle" id="Detalle" placeholder="Describir detalle del ingreso" required>
                            <div class="invalid-feedback">Complete los datos</div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputName" class="form-label"><b>Cantidad</b></label>
                            <input type="text" class="form-control" name="Cantidad" id="Cantidad" placeholder="Ingresar Cantidad" required>
                            <div class="invalid-feedback">Complete los datos</div>
                        </div>

                        <div class="col-6">
                            <label for="inputDescription" class="form-label"><b>Fecha</b></label>
                            <input type="date" class="form-control" name="fecha" id="fecha">
                        </div>


                        <div class="col-12">
                            <br>
                            <button type="button" class="btn btn-primary" onclick="RegistrarIngreso()"> Guardar Ingreso</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal Editar Ingreso-->
    <div class="modal fade" id="ModalEditarIngreso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-file-text"></i> <b>Modificar Ingreso</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="formRegistroProductos" class="row g-3 needs-validation" novalidate>
                        <div class="col-md-12">
                            <label for="inputCodigo" class="form-label"><b>Detalle</b></label>
                            <input type="text" class="form-control" name="Detalle" id="Detalle1" placeholder="Describir detalle del ingreso" required>
                            <div class="invalid-feedback">Complete los datos</div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputName" class="form-label"><b>Cantidad</b></label>
                            <input type="text" class="form-control" name="Cantidad" id="Cantidad1" placeholder="Ingresar Cantidad" required>
                            <div class="invalid-feedback">Complete los datos</div>
                        </div>
                        <div class="col-md-6">
                            <input type="HIDDEN" class="form-control" name="id" id="id1">
                        </div>

                        <div class="col-12">
                            <br>
                            <button type="button" class="btn btn-primary" onclick="ModificarIngreso()"> Guardar Ingreso</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Registrar ingreso-->
    <script>
        function RegistrarIngreso() {

            var detalle = $('#Detalle').val();
            var cantidad = $('#Cantidad').val();
            var fecha = $('#fecha').val();

            if (detalle == "" || cantidad == "") {
                return MostrarAlerta("Datos incompletos..!", "Debe ingresar todos los campos", "warning");
            }

            $.ajax({

                url: 'Clases/Cl_Ingresos.php?op=registrarIngreso',
                type: 'POST',
                data: {
                    Detalle: detalle,
                    Cant: cantidad,
                    Fecha: fecha
                },

                success: function(vs) {
                    if (vs == 1) {
                        MostrarAlerta("Correcto..!", "Ingreso registrado correctamente", "success");
                        $('#datatablesSimple').load('RegistroIngresos.php #datatablesSimple')
                        $('#exampleModal').modal('hide');
                    }else{
                        if (vs == 2) {
                        MostrarAlerta("Error..!", "ha ocurrido un error", "error");
                        
                        }
                    }
                    
                }
            })

        }
    </script>
  

   <!--Llama al modal modificar ingreso y le manda los campos de la fila-->
   <script>
        function editarIngresoModal(id,categoria,cantidad) {    
            $('#id1').val(id);  
            $('#Detalle1').val(categoria);
            $('#Cantidad1').val(cantidad);
            $('#ModalEditarIngreso').modal('show');
        }
    </script>



    <!-- Confirmacion para eliminar ingreso-->
   <script>
       function ConfirmarModificarIngreso(id) {
            Swal.fire({
            title: 'Esta Seguro?',
            text: "Una vez eliminado ya no se podra recuperar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!'
            }).then((result) => {
                    if (result.isConfirmed) {
                        ElimnarIngreso(id);
                        
                    }
            })
       }
   </script>

<!-- Eliminar gasto-->
<script>
        function ElimnarIngreso(id1) {
           
            var id = id1;
           
            $.ajax({

            url: 'Clases/Cl_Ingresos.php?op=EliminarIngreso',
            type: 'POST',
            data: {
                Id: id            
                }, 
                success: function(vs) {
                    if (vs == 2) {
                        MostrarAlerta("Error..!", "ha ocurrido un error", "error");
                        return false;
                    }else{
                        Swal.fire(
                        'Eliminado!',
                        'Tu Ingreso ha sido eliminado.',
                        'success'
                        )
                        $('#datatablesSimple').load('RegistroIngresos.php #datatablesSimple')
                    }
                    
                }
            })
           
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="js/sweetAlert.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- CODIGO PARA VALIDACION DE CAMPOS VACIOS-->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    <script>
        function MostrarAlerta($titulo, $texto, $icono) {
            Swal.fire({
                    title: $titulo,
                    text: $texto,
                    icon: $icono
                }

            )

        }
    </script>
</body>

</html>