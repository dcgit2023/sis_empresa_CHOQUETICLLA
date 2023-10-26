<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]." &nbsp;&nbsp; " ;
       echo "ROL:  ".$_SESSION["sesion_rol"]."</h3>";
         echo"<h1>MODIFICAR EMPRESA</h1>";

$sql = $db->Prepare("SELECT *
                     FROM empresa
                     WHERE id_empresa = 1
                     AND estado <> 'X'                  
                        ");
$rs = $db->GetAll($sql);
$logo =$rs[0]["logo"];
  foreach($rs as $k => $fila){
    echo"<form action='empresa1.php' method='post' name='formu' enctype='multipart/form-data'>";
    echo"<center>
            <table class='listado'>
              <tr>
                <th><b>(*)Nombres</b></th><td><input type='text' name='nombres' size='20'
                onkeyup='this.value=this.value.toUpperCase()' value ='".$fila["nombres"]."'></td>
              </tr>
              <tr>
                <th><b>Direccion</b></th>
                <td><input type='text' name='direccion' size='20' onkeyup='this.value=this.value.toUpperCase()' value ='".$fila["direccion"]."'></td>
              </tr>
              <tr>

                    <th><b>Logo</b></th>
                    <td>
                        <input type='hidden' name='MAX_FILE_SIZE' value ='1000000'> 
                        <input type='hidden' name='logo1' value ='".$fila["logo"]."'>
                        <input type='file' name='logo' size='10'><br>";
                        echo $fila["logo"];
                        echo "</td>
                  <tr>
                    <th><b>(*)Fecha_inicio</b></th><td><input type='date' name='fec_inicio' size='20' onkeyup='this.value=this.value.toUpperCase()' value ='".$fila["fec_inicio"]."'>
                    </td>
                  </tr>

                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='MODIFICAR EMPRESA'  >
                      <input type='hidden' name='id_empresa' value='".$fila["id_empresa"]."'>
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
}
echo "</body>
      </html> ";

 ?>