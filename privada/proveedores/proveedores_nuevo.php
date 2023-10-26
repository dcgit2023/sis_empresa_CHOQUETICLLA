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
       <a  href='proveedores.php'>Listado de Proveedores</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";

       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]." &nbsp;&nbsp; " ;
       echo "ROL:  ".$_SESSION["sesion_rol"]."</h3>";
         echo" <h1>INSERTAR EMPLEADO</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ', em.nombres) as proveedor, id_empresa
                     FROM empresa em
                     WHERE estado <> 'X'                 
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<form action='proveedores_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Empresa</th>
                    <td>
                      <select name='id_empresa'>
                        <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_empresa']."'>".$fila['proveedor']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
             echo"<tr>
                    <th><b>(*)ap de proveedor</b></th>
                    <td><input type='text' name='nombre' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <th><b>(*)am de proveedor</b></th>
                    <td><input type='text' name='apellido' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <th><b>(*)C.I.</b></th>
                    <td><input type='text' name='ci' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR PROVEEDOR'><br>
                      (*)Datos Obligatorios
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    }

echo "</body>
      </html> ";

 ?>