<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;

$id_cliente = $_POST["id_cliente"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";
         

$sql = $db->Prepare("SELECT *
                    FROM clientes
                    WHERE id_cliente = ? 
                    AND estado <>'X'                       
                        ");
$rs = $db->GetAll($sql, array($id_cliente));
/*  if ($rs) {*/



  foreach($rs as $k => $fila){
    echo"<form action='clientes_modificar1.php' method='post' name='formu'>";
    echo"<center>
    <h1>MODIFICAR CLIENTES</h1>
            <table class='listado'>
              <tr>
                <th><b>Apellido</b></th>
                <td><input type='text' name='apellido' size='10' onkeyup='this.value=this.value.toUpperCase()' value ='".$fila["apellido"]."'></td>
              </tr>
                  <tr>
                    <th><b>(*)Nombre</b></th><td><input type='text' name='nombre' size='10' onkeyup='this.value=this.value.toUpperCase()' value ='".$fila["nombre"]."'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Dirección</b></th>
                    <td><input type='text' name='direccion' size='10' onkeyup='this.value=this.value.toUpperCase()' value ='".$fila["direccion"]."'>
                    </td>
                  </tr>
                  <tr>
                    <th><b>Telefono</b></th><td><input type='text' name='telefono' size='10' value ='".$fila["telefono"]."'></td>
                  </tr>
                  <tr>
                    <th><b>Email</b></th><td><input type='text' name='email' size='10' value ='".$fila["email"]."'></td>
                  </tr>

                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='MODIFICAR CLIENTES'  >
                      <input type='hidden' name='id_cliente' value='".$fila["id_cliente"]."'>
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/
}

echo "</body>
      </html> ";

 ?>