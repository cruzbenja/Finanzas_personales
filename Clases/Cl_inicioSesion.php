<?php
session_start();

    include("conexion.php");

        $usuario = $_POST["user"];
        $password = $_POST["pass"];
    
        $sql = "select id,usuario,contra,idPersona from usuario where usuario ='$usuario'";
       
        $resultado = mysqli_query($conectar,$sql);
        $num = $resultado->num_rows;
    
        if($num > 0){
            $row = $resultado->fetch_assoc();
            $password_bd = $row['contra'];  
            $idPersona = $row['idPersona'];

            $sql1 = "select nombre,apellidos from persona where id ='$idPersona'";      
            $resultado1 = mysqli_query($conectar,$sql1);
            $row1 = $resultado1->fetch_assoc();
            
            
            if($password_bd == $password){
                $_SESSION['id'] = $row['id'];
                $_SESSION['usuario'] = $row['usuario'];     
                $_SESSION['contra']  = $password_bd;         
                $_SESSION['idPersona'] = $row['idPersona'];
                $_SESSION['nombre'] = $row1['nombre'];
                $_SESSION['apellidos']  = $row1['apellidos'];

                echo '1';
            }
            else{
                
               echo '2';
            }
        }
        else{
            //echo "El usuario no existe";
            echo '3';
        }
?>