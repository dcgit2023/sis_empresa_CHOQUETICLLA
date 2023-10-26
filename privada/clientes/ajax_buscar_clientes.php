<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$apellidos = $_POST["apellidos"];
$nombres = $_POST["nombres"];
$telefono = $_POST["telefono"];

$db->debug=true;
if ($apellidos or $nombres or $telefono){
    $sql3 = $db->Prepare("SELECT *
                            FROM clientes
                            WHERE apellido LIKE ? 
                            AND nombre LIKE ? 
                            AND telefono LIKE ? 
                            AND estado <> 'X'    

                        ");
    $rs3 = $db->GetAll($sql3, array($apellidos."%", $nombres."%", $telefono."%"));
        if ($rs3) {
            echo"<center>
                <table class='listado'>
                    <tr>                                   
                    <th>APELLIDOS</th><th>NOMBRES</th><th>TELEFONO</th>
                    <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                    </tr>";
                foreach ($rs3 as $k => $fila) {  
                    $str1 = $fila ["apellido"];
                    $str2 = $fila ["nombre"];
                    $str3 = $fila ["telefono"];
                   
                    
                echo"<tr>
                            <td align='center'>".resaltar($apellidos, $str1)."</td>
                            <td>".resaltar($nombres, $str2)."</td>
                            <td>".resaltar($telefono, $str3)."</td>
                            <td align='center'>
                          <form name='formModif".$fila["id_cliente"]."' method='post' action='clientes_modificar.php'>
                            <input type='hidden' name='id_cliente' value='".$fila['id_cliente']."'>
                            <a href='javascript:document.formModif".$fila['id_cliente'].".submit();' title='Modificar Cliente Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_cliente"]."' method='post' action='clientes_eliminar.php'>
                            <input type='hidden' name='id_cliente' value='".$fila["id_cliente"]."'>
                            <a href='javascript:document.formElimi".$fila['id_cliente'].".submit();' 
                            title='Eliminar Cliente Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al Cliente ".$fila["apellido"]." ".$fila["nombre"]." ".$fila["telefono"]." ?\"))'; location.href='clientes_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form>                        
                        </td>
                        </tr>";

                    }
                    echo"</table>
                    </center>";
        }else{
            echo"<center><b> EL CLIENTE NO EXISTE!!</b></center><br>";
        }
}
    
?>