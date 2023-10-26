<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$id_empresa = $_POST["id_empresa"];
$ap = $_POST["ap"];
$am = $_POST["am"];
$ci = $_POST["ci"];

if(($id_empresa!="") and  ($ap!="") and ($am!="") and ($ci!="")){
   $reg = array();
   $reg["id_empresa"] = $id_empresa;
   $reg["ap"] = $ap;
   $reg["am"] = $am;
   $reg["ci"] = $ci;
   $reg["fecha_insercion"] = date("Y-m-d H:i:s");
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];
   $reg["estado"] = 'A';
   $rs1 = $db->AutoExecute("proveedores", $reg, "INSERT"); 
   header("Location: proveedores.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL EMPLEADO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='empleados_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 