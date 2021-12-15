<?php
include "Clases/conexion.php";
session_start();

    if($_POST){
    
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
    
        $sql = "select id,usuario,password,idEmpleado,email from usuarios where usuario ='$usuario'";
       
        $resultado = mysqli_query($conectar,$sql);
        $num = $resultado->num_rows;
    
        if($num > 0){
            $row = $resultado->fetch_assoc();
            $password_bd = $row['password'];
    
           # $pass_c = sha1($password);
    
            if($password_bd == $password){
                $_SESSION['id'] = $row['id'];
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['idEmpleado'] = $row['idEmpleado'];
    
                header("Location: index.php");
            
            }
            else{
                echo"La contraseña no coincide";
            }
        }
        else{
            echo "El usuario no existe";
        }
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
        <title>Autenticación - Sistema</title>
        <link href="css/login.css" rel="stylesheet" />
        <link href="css/cabecera.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-danger">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"></h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="<?php  echo $_SERVER['PHP_SELF']; ?>">
                                        <h1>Inicio de Sesión</h1>
                                            <div class="form-floating mb-3">
                                                <p for="text">Usuario</p>    
                                                <input class="form-control" id="inputEmail" name="usuario" type="text" placeholder="Ingrese su usuario"/>                        
                                            </div>
                                            <div class="form-floating mb-3">
                                                <p for="inputPassword">Contraseña</p>
                                                <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Ingrese su Contraseña"/>                            
                                            </div>
                                                <input type="submit" value="Ingresar"class="btn btn-primary"></input>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
