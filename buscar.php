<?php

if($cn = new mysqli('localhost','root','','buscador_ajax')){
$cn->query("SET_NAMES,'utf-8'");
}
else{
    echo 'Error de conexión' .$cn->error;
}

$salida_datos = "";
$sql = "SELECT * FROM smartphones";

if(isset($_POST['consulta'])){
    $q = $cn->real_escape_string($_POST['consulta']);
    $sql = "SELECT * FROM smartphones WHERE marca LIKE '$q%' OR modelo LIKE '$q%'";
}

$resultado = $cn->query($sql);

if($resultado->num_rows > 0){
    $salida_datos.= "<table class='table table bordered'>
    <thead>
        <tr>
            <th>Código</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Precio</th>
        </tr>
    </thead>
    <tbody>";

    while($fila = $resultado->fetch_assoc()){
        $salida_datos.= "<tr>
            <td>" . $fila['codigo'] . "</td>
            <td>" . $fila['marca'] . "</td>
            <td>" . $fila['modelo'] . "</td>
            <td>" . str_replace(chr(128),"€",$fila['precio']) . "</td>
        </tr>";
    }

    $salida_datos.="</tbody></table>";
    
}
else{
    $salida_datos.= 'No hay datos';
}

echo $salida_datos;
$cn->close();












?>