<?php
$host = '192.168.1.80';
$port = '5432'; 
$dbname = 'gimnasio';
$user = 'geovani'; 
$password = 'geovani';

try {
    $dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $host, $port, $dbname);
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING);
    $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
    $direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);
    $fecha_nacimiento = filter_input(INPUT_POST, 'fecha_nacimiento', FILTER_SANITIZE_STRING);
    $contra = $_POST['contra'];

    if ($nombre && $apellidos && $correo && $telefono && $direccion && $fecha_nacimiento && $contra) {
        try {
            // Generar un ID de usuario (puedes obtenerlo desde un formulario o asignarlo automáticamente)
            $id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT); // El id debe ser proporcionado en el formulario

            // Verificar si el ID ya existe en la base de datos
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM Usuarios WHERE id = :id_usuario');
            $stmt->execute(['id_usuario' => $id_usuario]);
            $usuarioExistente = $stmt->fetchColumn();

            if ($usuarioExistente > 0) {
                echo "El ID ya está registrado.";
                exit;
            }

            // Encriptar la contraseña
            $contra_encriptada = password_hash($contra, PASSWORD_BCRYPT);

            // Insertar el nuevo usuario en la base de datos
            $stmt = $pdo->prepare(
                'INSERT INTO Usuarios (id, nombre, apellidos, correo, telefono, direccion, fecha_nacimiento, contra) 
                VALUES (:id_usuario, :nombre, :apellidos, :correo, :telefono, :direccion, :fecha_nacimiento, :contra)'
            );
            $stmt->execute([
                'id_usuario' => $id_usuario,
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'correo' => $correo,
                'telefono' => $telefono,
                'direccion' => $direccion,
                'fecha_nacimiento' => $fecha_nacimiento,
                'contra' => $contra_encriptada
            ]);

            // Crear el nombre de usuario basado en el correo o en cualquier otro criterio
            $nombre_usuario = strtolower(explode('@', $correo)[0]);

            // Crear el usuario a nivel de PostgreSQL
            $sql_crear_usuario = "CREATE USER $nombre_usuario WITH PASSWORD '$contra'";
            $pdo->exec($sql_crear_usuario);

            // Asignar el rol de "cliente" al usuario creado (basado en el nombre de usuario)
            $sql_grant_cliente = "GRANT cliente TO $nombre_usuario";
            $pdo->exec($sql_grant_cliente);

            echo "Registro exitoso. Bienvenido/a, $nombre.";
        } catch (PDOException $e) {
            echo "Error al registrar usuario: " . $e->getMessage();
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}
?>
