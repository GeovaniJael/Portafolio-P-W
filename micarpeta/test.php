<?php
// Configuración de la base de datos
$host = '192.168.1.77'; // Dirección del servidor PostgreSQL
$port = '5432'; // Puerto del servidor PostgreSQL (por defecto: 5432)
$dbname = 'gimnasio'; // Nombre de la base de datos
$user = 'geovani'; // Usuario de PostgreSQL
$password = 'geovani'; // Contraseña del usuario

try {
    // Crear una instancia de PDO para PostgreSQL
    $dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $host, $port, $dbname);
    $pdo = new PDO($dsn, $user, $password);

    // Configurar atributos de PDO para el manejo de errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consultar las clases
    $sql = "SELECT * FROM clases";
    $stmt = $pdo->query($sql); // Ejecutar consulta

    // Obtener resultados
    $clases = $stmt->fetchAll();


    echo "<table>";
    echo "<tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Instructor</th>
            <th>Cupo Máximo</th>
            <th>Horario</th>
            <th>Días de la Semana</th>
            <th>Costo</th>
          </tr>";
    foreach ($clases as $clase) {
        echo "<tr>
                <td>{$clase['id']}</td>
                <td>{$clase['nombre']}</td>
                <td>{$clase['instructor']}</td>
                <td>{$clase['cupo_maximo']}</td>
                <td>{$clase['horario']}</td>
                <td>{$clase['dias_semana']}</td>
                <td>{$clase['costo']}</td>
              </tr>";
    }
    echo "</table>";

} catch (PDOException $e) {
    // Manejo de errores
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}
?>
