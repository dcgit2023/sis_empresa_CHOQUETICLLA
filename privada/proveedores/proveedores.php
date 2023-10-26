<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ', pro.ap, pro.am, pro.ci) AS proveedor, em.* 
                     FROM proveedores pro, empresa em
                     WHERE  pro.id_empresa = em.id_empresa
                     AND em.estado <> 'X' 
                     AND pro.estado <> 'X' 
                     ORDER BY em.id_empresa DESC                    
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
        <h1>LISTADO DE PROVEEDORES</h1>
        <a  href='proveedores_nuevo.php'>Nuevo Proveedor</a>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>PERSONA</th><th>NOMBRE EMPRESA</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['proveedor']."</td>                        
                        <td>".$fila['nombres']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_empresa"]."' method='post' action='persona_modificar.php'>
                            <input type='hidden' name='id_empresa' value='".$fila['id_empresa']."'>
                            <a href='javascript:document.formModif".$fila['id_empresa'].".submit();' title='Modificar proveedor Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_empresa"]."' method='post' action='persona_eliminar.php'>
                            <input type='hidden' name='id_empresa' value='".$fila["id_empresa"]."'>
                            <a href='javascript:document.formElimi".$fila['id_empresa'].".submit();' title='Eliminar Persona Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al Proveedor ".$fila["usuario"]." ?\"))'; location.href='persona_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form>                        
                        </td>
                     </tr>";
                     $b=$b+1;
            }
             echo"</table>
          </center>";
    }

echo "</body>
      </html> ";

 ?>