<?php

include_once '../model/cidade.php';
include_once '../model/cidadeDB.php';
include_once '../model/estado.php';
include_once '../model/estadoDB.php';


$cidadeDB = new CidadeDB();
$estadoDB = new EstadoDB();


$list_estados =  $estadoDB->selectAll();
$list = $cidadeDB->selecionaTodas();

$listReturn = array();

$i=0;

foreach($list_estados as $estado){
    $listReturn[$i] = $estado->getNome();
    $i++;
}


foreach($list as $cidade){
    $listReturn[$i] = $cidade->getNome()."-".$cidade->getUf();
    $i++;
}

echo(json_encode($listReturn));




?>