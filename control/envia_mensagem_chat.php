<?php


include_once '../model/mensagem.php';
include_once '../model/mensagemDB.php';


session_start();

$idempresa=0;
$idtransacao=0;
$texto="";


if(isset($_POST['texto']))
    $texto = $_POST['texto'];

if($texto!= "" & isset($_SESSION['idempresa']) & isset($_SESSION['idtransacao']) ){

    $idempresa = $_SESSION['idempresa'];
    $idtransacao = $_SESSION['idtransacao'];
    $mensagemDB = new MensagemDB();
    $mensagem =new Mensagem();

    $mensagem->setIdtransacao($idtransacao);
    $mensagem->setIdempresa($idempresa);
    $mensagem->setTexto($texto);
    $mensagemDB->inserir($mensagem);


}






?>