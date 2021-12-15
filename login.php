<?php
include "Clases/conexion.php";
session_start();

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <title>Autenticación - Sistema</title>
        <style>
            .bg{
                background-image: url(IMG/SoftwareBolivia.png);
                background-position: center center;
            }
        </style>
    </head>
    <body>
        
        <div class="container w-75 bg-primary mt-5 rounded shadow">
            <div class="row align-items-stretch">
                <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">

                </div>
                <div class="col p-5 rounded-end">
                    <div class="text-center">
                        <img src="IMG/logo.png" width="68" alt="">
                    </div>

                    <H2 class="fw-bold text-center py-3">Bienvenido</H2>

                    <!-- login -->
                    <form method="POST" id="FormDatosUsuario">
                        <div class="mb-4">
                            <label for="text" class="form-label">Usuario</label>
                            <input type="text" class="form-control" name="usuario" id ="usuario">
                        </div>
                        <div class="mb-4">
                        <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="password" id ="password">
                        </div>
                        <div class="d-grid">
                            <button type="button" class="btn btn-secondary" onclick="verificarUsuario()">Iniciar sesion</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>

        <script>

            function verificarUsuario(){
                var usuario = $("#usuario").val();
                var password = $("#password").val();
               if(usuario == "" || password == ""){
                   return MostrarAlerta("Datos incompletos","Debe ingresar el usuario y la contraseña","warning");
               }
                
               $.ajax({                
                   url:'Clases/Cl_inicioSesion.php',
                   type:'POST',
                   data:{
                       user: usuario,
                       pass: password                    
                   },
                   success: function(resp){
                        if(resp == 1){
                            window.location.href = "index.php";
                        }
                        else{
                            if(resp == 2){
                                MostrarAlerta("Ops..!","Usuario y/o contraseña incorrectos","Error");
                            }
                            else{
                            if(resp == 3){
                                MostrarAlerta("Error..!","Usuario ingresado no existe","Error");
                            }
                        }
                        }
                   }
                   });
                   
            }
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
