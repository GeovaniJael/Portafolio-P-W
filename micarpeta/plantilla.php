<?php
$nombre = "Geovani Torres";
include  "header.php";
include  "footer.php";
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla php</title>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
>
</head>
<body>
    <main class="container">
        <article>
            <p>Hola me llamo <?= $nombre ?>  </p>
        </article>
    </main>
</body>
</html>