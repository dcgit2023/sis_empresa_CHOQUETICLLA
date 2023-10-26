<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";

$id_empresa = $_POST["id_empresa"];
$nombres = $_POST["nombres"];
$direccion = $_POST["direccion"];
$fec_inicio = $_POST["fec_inicio"];

$logo1 = $_POST["logo1"];

$nombre_log = $_FILES['logo']['name'];

//esto es para guardar la imagen 

if ((!empty($_FILES['logo'])) and is_uploaded_file($_FILES['logo']['tmp_name'])) {
    copy($_FILES['logo']['tmp_name'],'logos/'.$nombre_log);
    $logo = $_FILES['logo']['name'];
} elseif ($logo1 == "") {
    $nombre_log = '';
} else 
$nombre_log = $logo1;

if(($nombres!="") and  ($direccion!="")){
   $reg = array();
   $reg["id_empresa"] = 1;
   $reg["nombres"] = $nombres;
   $reg["direccion"] = $direccion;
   $reg["logo"] = $nombre_log;
   $reg["fec_inicio"] = $fec_inicio;
 
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("empresa", $reg, "UPDATE", "id_empresa='".$id_empresa."'"); 
   header("Location: ../../listado_tablas.php");
   exit();
} else {
    if(!$rs1){
        echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DE LA EMPRESA";
        echo"<h1>".$mensage."</h1>";

        echo"<a href='empresa.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
        }
      
   }


echo "</body>
      </html> ";
?> 



