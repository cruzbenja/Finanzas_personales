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



$sql = "select * from categoria where estado = 'Activo'";

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
    <title>Categorias</title>
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
                    <h1 class="mt-4">Categorias</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Escritorio</a></li>
                        <li class="breadcrumb-item active">Categorias</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-circle"></i> Crear Categoria</a>

                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-secondary table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Categoria</th>    
                                        <th>Estado</th>                                  
                                        <th width= 150px>Acción</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $cont = 0;
                                    while ($row = $resultado->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['nombreCategoria']; ?></td>
                                            <td><?php echo $row['estado']; ?></td>
                                            <td><button type='button' class='btn btn-success btn-sm checkbox-toggle' onclick="ModalModificarCategoria('<?php echo $row['id']; ?>','<?php echo $row['nombreCategoria']; ?>')"> <i title="Editar" class="bi bi-pencil"></i>  Editar</button>
                                          
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


    <!-- Modal Registrar categoria -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-file-text"></i> <b> Crear Categoria</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="formRegistroProductos" class="row g-3">
                        <div class="col-md-12">
                            <label for="inputName" class="form-label"><b>Nombre Categoria</b></label>
                            <input type="text" class="form-control" name="nombre" placeholder="Ingresar nombre">
                        </div>                    
                        <div class="col-12">
                            <br>
                            <button type="subtmit" class="btn btn-primary" id="registrarProducto"> Crear Categoria</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal modificar categoria -->
    <div class="modal fade" id="ModificarCategoriaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-file-text"></i> <b> Modificar Categoria</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="formRegistroProductos" class="row g-3">
                        <div class="col-md-12">
                            <label for="inputName" class="form-label"><b>Nombre Categoria</b></label>
                            <input type="text" class="form-control" name="nombre" id="categoria" placeholder="Ingresar Categoria">
                        </div>              
                        <div class="col-md-6">
                            <input type="HIDDEN" class="form-control" name="id" id="id">
                        </div>      
                        <div class="col-12">
                            <br>
                            <button type="button" class="btn btn-primary" id="registrarProducto" onclick="EditarCategoria()"> Actualizar Categoria</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
                                


 <!--funcion Actualizar categoria-->
    <script>
        function EditarCategoria(){

            var Id = $('#id').val();
            var Categoria = $('#categoria').val();

            $.ajax({
                url: 'Clases/Cl_Categoria.php?op=ModificarCategoria',
                type:'POST',
                data:{
                    Id1:Id,
                    Categoria1: Categoria                
                },
                success: function(vs) {
                    if(vs == 1){
                        MostrarAlerta("Exito..!", "Actualizado correctamente", "success");
                        $('#datatablesSimple').load('RegistroCategoria.php #datatablesSimple')
                        $('#ModificarCategoriaModal').modal('hide');
                    }
                    else{
                        if(vs== 2){
                            MostrarAlerta("Ops..!","Ha ocurrido un error inesperado", "error");
                        } else{
                            if(vs== 3){
                                MostrarAlerta("Campos Vacios..!","Debe ingresar el nombre de la categoria", "warning");
                            }
                        
                        }
                        
                    }
                }
            })
        }
    </script>



      <!--Llama al modal modificar categoria y le manda los campos de la fila-->
    <script>
        function ModalModificarCategoria(id,categoria) {      
        $('#id').val(id);  
        $('#categoria').val(categoria);

        $('#ModificarCategoriaModal').modal('show');
            }
    </script>



    <!-- Registrar productos-->
    <script>
        $(Document).ready(function() {

            $('#registrarProducto').click(function(e) {
                e.preventDefault();
                var recolec = $('#formRegistroProductos').serialize();
                $.ajax({

                    url: 'Clases/Cl_Categoria.php?op=registrarCategoria',
                    type: 'POST',
                    data: recolec,

                    success: function(vs) {
                       
                        if (vs == 1) {
                            MostrarAlerta("Datos incompletos..!", "Debe ingresar el nombre de la categoria", "warning");
                        } else {
                            if (vs == 2) {
                                MostrarAlerta("Ops..!", "Ya existe un producto con ese codigo", "error");
                            } else {
                                if (vs == 3) {
                                    MostrarAlerta("Correcto!", "Producto registrado exitosamente", "success");
                                        $('#datatablesSimple').load('RegistroCategoria.php #datatablesSimple')
                                        $('#exampleModal').modal('hide');
                                        
                                } else {
                                    if (vs == 4) {
                                        MostrarAlerta("Ops..!", "Error al registrar, favor intentar de nuevo", "error");
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