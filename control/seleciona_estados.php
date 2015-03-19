<?php




include_once '../model/estado.php';
include_once '../model/estadoDB.php';


$estadoDB = new EstadoDB();
$list = $estadoDB->selectAll();

$listReturn = array();

$i=0;

foreach($list as $estado){
    $listReturn[$i] = $estado->getJSONFormat();
    $i++;
}

echo(json_encode($listReturn));

?>