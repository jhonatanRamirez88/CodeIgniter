<?php







$user = "postgres";
$password = "postgres";
$dbname = "rgjs";
$port = 5432;
$host = "localhost";

$cadenaConexion = "host=$host port=$port dbname=$dbname user=$user password=$password";

$conexion = pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());
echo "<h3>Conexion Exitosa PHP - PostgreSQL</h3><hr><br>";

$query = "select id, usuario, contrasenia from usuario";

$resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");

$numReg = pg_num_rows($resultado);

if($numReg>0){
echo "<table border='1' align='center'>
<tr bgcolor='skyblue'>
<th>ID</th>
<th>Usuario</th>
<th>Contrasena</th></tr>";
while ($fila=pg_fetch_array($resultado)) {
echo "<tr><td>".$fila['id']."</td>";
echo "<td>".$fila['usuario']."</td>";
echo "<td>".$fila['contrasenia']."</td></tr>";
}
                echo "</table>";
}else{
                echo "No hay Registros";
}

pg_close($conexion);

?>