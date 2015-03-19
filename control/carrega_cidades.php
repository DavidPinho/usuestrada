<?php

include_once '../model/cidade.php';
include_once '../model/cidadeDB.php';


$codEstado = $_POST['codEstado'];

$cidadeDB = new CidadeDB();

$list = $cidadeDB->selecionaPorEstado($codEstado);

$listReturn = array();

$i=0;

foreach($list as $cidade){
    $listReturn[$i] = $cidade->getJSONFormat();
    $i++;
}

echo(json_encode($listReturn));





?>