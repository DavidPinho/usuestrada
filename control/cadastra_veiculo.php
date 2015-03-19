<?php


include_once '../model/veiculo.php';
include_once '../model/veiculoDB.php';
include_once '../php_utils/ImageUtils.php';


$veiculo = new Veiculo();
$list_erro_return= array();
$erro_count =0;
$veiculoDB = new VeiculoDB();


$antt = trim($_POST['txt_antt']);
if(empty($antt)||$antt==''){
    $list_erro_return[$erro_count]="antt;"."Informe seu código da ANTT";
    $erro_count++;
}


$placa = trim($_POST['txt_placa']);
if(empty($placa)||$placa==''){
    $list_erro_return[$erro_count]="placa;"."Informe a placa do veículo";
    $erro_count++;
}

$marca = trim($_POST['txt_marca']);
if(empty($marca)||$marca==''){
    $list_erro_return[$erro_count]="marca;"."Informe marca";
    $erro_count++;
}

$modelo = trim($_POST['txt_modelo']);
if(empty($modelo)||$modelo==''){
    $list_erro_return[$erro_count]="modelo;"."Informe modelo";
    $erro_count++;
}

$ano = trim($_POST['txt_ano']);
if(empty($ano)||$ano==''){
    $list_erro_return[$erro_count]="ano;"."Informe ano";
    $erro_count++;
}

$rastreador = trim($_POST['list_rastreador']);
if(empty($rastreador)||$rastreador==0){
    $list_erro_return[$erro_count]="list_rastreador;"."Selecione";
    $erro_count++;
}

$tipo = trim($_POST['list_tipo']);
if(empty($tipo)||$tipo==0){
    $list_erro_return[$erro_count]="list_tipo;"."Selecione";
    $erro_count++;
}

$carroceria = trim($_POST['list_carroceria']);
if(empty($carroceria)||$carroceria==0){
    $list_erro_return[$erro_count]="list_carroceria;"."Selecione";
    $erro_count++;
}

$icon_path="";
if(!empty($_FILES['img_logo'])){
    $icon_path=ImageUtils::createAndValidateIcon($_FILES['img_logo']);
    if($icon_path=="denied")
        $icon_path="";

}

$status =  trim($_POST['list_status']);
if($status==2)
    $status=0;

$cidade = trim($_POST['list_cidades']);
if(empty($cidade)||$cidade==0){
    $cidade=981;  //Número da cidade de Salvador no BD
}



if($erro_count>0){
    $form_return=array("op_code"=>"erro","list_error"=>$list_erro_return);
    echo json_encode($form_return);
    return;
}

session_start();

$idempresa = $_SESSION["idempresa"];


$veiculo->setAntt($antt);
$veiculo->setPlaca($placa);
$veiculo->setMarca($marca);
$veiculo->setModelo($modelo);
$veiculo->setAno($ano);
$veiculo->setCarroceria($carroceria);
$veiculo->setIdempresa($idempresa);
$veiculo->setRastreador($rastreador);
$veiculo->setTipo($tipo);
$veiculo->setImagem($icon_path);
$veiculo->setStatus($status);
$veiculo->setCidadeDisponivel($cidade);


$result = $veiculoDB->insert($veiculo);

$form_return=array("op_code"=>"success","new_id"=>$result);

echo json_encode($form_return);





?>