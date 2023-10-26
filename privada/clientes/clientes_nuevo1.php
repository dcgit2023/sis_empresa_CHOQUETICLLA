<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       
$apellido = $_POST["apellido"];
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$email = $_POST["email"];

if(($nombre!="") and  ($apellido!="")){
   $reg = array();
   $reg["id_empresa"] = 1;
   $reg["apellido"] = $apellido;
   $reg["nombre"] = $nombre;
   $reg["direccion"] = $direccion;
   $reg["telefono"] = $telefono;
   $reg["email"] = $email;
   $reg["fecha_insercion"] = date("Y-m-d H:i:s");
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];
   $reg["estado"] = 'A';
   $rs1 = $db->AutoExecute("clientes", $reg, "INSERT"); 
   header("Location: clientes.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL CLIENTE";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='clientes_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 