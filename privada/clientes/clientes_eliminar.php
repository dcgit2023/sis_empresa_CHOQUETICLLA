<?php
session_start();
require_once("../../conexion.php");


$id_cliente = $_REQUEST["id_cliente"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";
//$db->debug=true;

/*las consultas se tienen que hacer con todas las tablas en las que id_cliente esta como herencia */
$sql = $db->Prepare("SELECT *
                    FROM ventas
                    WHERE id_cliente = ? 
                    AND estado <>'X'                       
                        ");
$rs = $db->GetAll($sql, array($id_cliente));



if(!$rs){
  $reg = array();
  $reg["estado"] = 'X';
  $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
  $rs1 = $db->AutoExecute("clientes", $reg, "UPDATE", "id_cliente='".$id_cliente."'"); 
  header("Location: clientes_eliminar.php");
  exit();
 
 } else {
  require_once("../../libreria_menu.php");
            echo"<div class='mensaje'>";
         $mensage = "NO SE ELIMINARON LOS DATOS DEL CLIENTE PORQUE TIENE HERENCIA";
         echo"<h1>".$mensage."</h1>";
         
         echo"<a href='clientes.php'>
                   <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
              </a>     
             ";
        echo"</div>" ;
    }
    echo"</div>";
   
 echo "</body>
       </html> ";
 ?> 