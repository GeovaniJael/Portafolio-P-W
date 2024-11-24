<?php
$titulo = "Gestor de usuarios";
include_once 'header.php';
$items = [
    ['nombre' => 'Geovani Jael', 'edad' => '19', 'correo'=>'manimata11.25@gmail.com'],
    ['nombre' => 'Jose Manuel', 'edad' => '55', 'correo'=>'mono.25@gmail.com'],

];
?>
cualquier cosa que yo quiera 
<article>
    <h2>Lista de usuarios</h2>
    <div class="overflow-autp">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Correo</th>
                    <th>
                        <i  class= "ph ph-gear" ></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= $item['nombre']?> </td>
                        <td><?= $item['edad']?> </td>
                        <td><?= $item['correo']?> </td>
                        <td>Opciones aqui</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</article>
<?php
include_once 'footer.php';
?>
