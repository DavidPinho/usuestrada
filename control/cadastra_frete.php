<?php


include_once '../model/frete.php';
include_once '../model/freteDB.php';

$frete = new Frete();
$list_erro_return= array();
$erro_count =0;
$freteDB = new FreteDB();


$tipo = trim($_POST['list_tipo']);
if(empty($tipo)||$tipo==0){
    $list_erro_return[$erro_count]="list_tipo;"."Selecione";
    $erro_count++;
}

$detalhes = trim($_POST['txt_detalhes']);
if(empty($detalhes)||$detalhes==''){
    $list_erro_return[$erro_count]="detalhes;"."Informe os detalhes";
    $erro_count++;
}

$estado_origem = trim($_POST['list_estado_origem']);
if(empty($estado_origem)||$estado_origem==0){
    $list_erro_return[$erro_count]="list_estado_origem;"."Selecione";
    $erro_count++;
}

$estado_destino = trim($_POST['list_estado_destino']);
if(empty($estado_destino)||$estado_destino==0){
    $list_erro_return[$erro_count]="list_estado_destino;"."Selecione";
    $erro_count++;
}

if($erro_count>0){
    $form_return=array("op_code"=>"erro","list_error"=>$list_erro_return);
    echo json_encode($form_return);
    header("Location: ".$_SERVER['HTTP_REFERER']."&erro=1");
    return;
}



$cidade_origem= trim($_POST['list_cidades_origem']);
$cidade_destino= trim($_POST['list_cidades']);


session_start();

$idempresa = $_SESSION["idempresa"];


$frete->setIdempresa($idempresa);
$frete->setTipo($tipo);
$frete->setDetalhes($detalhes);
$frete->setEstadoOrigem($estado_origem);
$frete->setCidadeOrigem($cidade_origem);
$frete->setCidadeDestino($cidade_destino);
$frete->setEstadoDestino($estado_destino);




$result = $freteDB->insert($frete);

$form_return=array("op_code"=>"success","new_id"=>$result);

echo json_encode($form_return);





