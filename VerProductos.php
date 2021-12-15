<?php
session_start();
include 'Clases/conexion.php';
require("Clases/conexion.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
} else {
    $id = $_SESSION['id'];
    $usuario = $_SESSION['usuario'];
    $tipoUsuario = $_SESSION['idEmpleado'];
}



$sql = "select * from vistaproductos where estado = 'Activo'";

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
    <title>Lista de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Sistema Inventarios</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->

        <!-- Navbar-->
        <?php
        require_once "template/menu-configuracion.php";
        ?>
    </nav>
    <div id="layoutSidenav">
        <?php
        require_once "template/encabezado.php";
        ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Listado de Productos</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Escritorio</a></li>
                        <li class="breadcrumb-item active">Listado de Productos</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-circle"></i> Nuevo Producto</a>

                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-secondary table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Código</th>
                                        <th>Producto</th>
                                        <th>Stock</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>Ubicación</th>
                                        <th>Almacen</th>
                                        <th>Categoria</th>
                                        <th>Marca</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $cont = 0;
                                    while ($row = $resultado->fetch_assoc()) { ?>
                                        <tr>

                                            <td><?php echo $cont = $cont + 1 ?></td>
                                            <td><?php echo $row['Codigo']; ?></td>
                                            <td><?php echo $row['nombre']; ?></td>
                                            <td><?php echo $row['sotck']; ?></td>
                                            <td><?php echo $row['descripcion']; ?></td>
                                            <td><?php echo $row['precio']; ?></td>
                                            <td><?php echo $row['ubicacion']; ?></td>
                                            <td><?php echo $row['almacen']; ?></td>
                                            <td><?php echo $row['categoria']; ?></td>
                                            <td><?php echo $row['marca']; ?></td>

                                            <td><button type='button' class='btn btn-success btn-sm checkbox-toggle'> <i title="Editar" class="bi bi-pencil"></i></button>
                                            </td>
                                            <td><button type='button' class='btn btn-danger btn-sm checkbox-toggle'><i title="Eliminar" class="bi bi-x-circle"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-file-text"></i> <b>Registrar Producto</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="formRegistroProductos" class="row g-3 needs-validation" novalidate>
                        <div class="col-md-6">
                            <label for="inputCodigo" class="form-label"><b>Codigo</b></label>
                            <input type="text" class="form-control" name="codigo" placeholder="Código numérico" required>
                            <div class="invalid-feedback">Complete los datos</div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputName" class="form-label"><b>Nombre</b></label>
                            <input type="text" class="form-control" name="nombre" placeholder="Ingresar nombre del producto" required>
                            <div class="invalid-feedback">Complete los datos</div>
                        </div>

                        <div class="col-12">
                            <label for="inputDescription" class="form-label"><b>Descripción</b></label>
                            <input type="text" class="form-control" name="descripcion" placeholder="Descripción de producto">
                        </div>
                        <div class="col-6">
                            <label for="inputPrecio" class="form-label"><b>Precio</b></label>
                            <input type="text" class="form-control" name="precio" placeholder="0,00" required>
                            <div class="invalid-feedback">Complete los datos</div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputStock" class="form-label"><b>Stock</b></label>
                            <input type="text" class="form-control" name="stock" placeholder="Si no tiene stock, colocar 0" required>
                            <div class="invalid-feedback">Si no tiene Stock colocar 0</div>
                        </div>
                        <div class="col-6">
                            <label for="inputUbicacion" class="form-label"><b>Ubicación</b></label>
                            <input type="text" class="form-control" name="ubicacion" placeholder="Ubicación dentro del almacén">
                        </div>
                        <div class="col-md-6">
                            <label for="inputAlmacen" class="form-label"><b>Almacen</b></label>
                            <select name="almacen" class="form-select" required>
                                <option selected disabled value="">Seleccione...</option>
                                <option>Almacen 1</option>
                                <option>Almacen 2</option>
                                <option>Almacen 3</option>
                            </select>
                            <div class="invalid-feedback">Complete los datos</div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputCategoria" class="form-label"><b>Categoría</b></label>
                            <select name="categoria" class="form-select" required>
                                <?php
                                $consulta = "SELECT * FROM categoria;";
                                $ejecutar = mysqli_query($conectar, $consulta) or die(mysqli_error($conectar));
                                ?>
                                <?php foreach ($ejecutar as $ocpiones) : ?>
                                    <option value="<?php echo $ocpiones['categoria'] ?>"><?php echo $ocpiones['categoria'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">Complete los datos</div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputMarca" class="form-label"><b>Marca</b></label>
                            <select name="marca" class="form-select" required>
                                <?php
                                $consulta = "SELECT * FROM marca;";
                                $ejecutar = mysqli_query($conectar, $consulta) or die(mysqli_error($conectar));
                                ?>
                                <?php foreach ($ejecutar as $ocpiones) : ?>
                                    <option value="<?php echo $ocpiones['marca'] ?>"><?php echo $ocpiones['marca'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">Complete los datos</div>
                        </div>
                        <div class="col-12">
                            <br>
                            <button type="subtmit" class="btn btn-primary" id="registrarProducto" required> Guardar Producto</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Registrar productos-->
    <script>
        $(Document).ready(function() {

            $('#registrarProducto').click(function(e) {
                e.preventDefault();
                var recolec = $('#formRegistroProductos').serialize();

                $.ajax({

                    url: 'Clases/Cl_Producto.php',
                    type: 'POST',
                    data: recolec,

                    success: function(vs) {
                        if (vs == 1) {
                            MostrarAlerta("Datos incompletos..!", "Debe ingresar todos los datos", "error");
                        } else {
                            if (vs == 2) {
                                MostrarAlerta("Ops..!", "Ya existe un producto con ese codigo", "error");
                            } else {
                                if (vs == 3) {
                                    MostrarAlerta("Ops..!", "Ya existe un producto con ese nombre", "error");
                                } else {
                                    if (vs == 4) {
                                        MostrarAlerta("Correcto!", "Producto registrado exitosamente", "success");
                                        $('#datatablesSimple').load('VerProductos.php #datatablesSimple')
                                        $('#exampleModal').modal('hide');
                                    } else {
                                        if (vs == 5) {
                                            MostrarAlerta("Ops..!", "Error al registrar, favor intentar de nuevo", "error");
                                        }
                                    }
                                }
                            }
                        }
                    }
                })

            });


        })
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