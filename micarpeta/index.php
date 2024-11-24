<?php
echo "Hola mundo, soy geova";
//hola
/**/
?>
<?= "Hola mundo"?>

<?php
$nombre = "Geovani";
$fdn = new DateTime("2004-11-25 13:01");
$altura = 1.83;
$casado =false;
define("Pi",3.14159);

?>
<h1> <?= $nombre ?> </h1>
<h3> <?= $altura ?> </h3>
<h2> <?= $fdn->format("d/M/Y h:i:s") ?> </h2>
<h4> <?= Pi ?> </h4>
<?php
$arreglo = [1,2,3];
foreach ($arreglo as $valor){
    echo $valor;
}
?>