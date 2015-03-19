<?php


session_start();

if(empty($_SESSION['idempresa'])){
    header("Location: login.php");
}


include_once '../model/transacaoDB.php';
include_once '../model/transacao.php';
include_once '../model/tracking.php';
include_once '../model/trackingDB.php';
include_once '../php_utils/utils.php';


$transacaoDB = new TrancasacaoDB();
$transacao = new Transacao();
$tracking = new Tracking();
$trackingDB = new TrackingDB();

$idembarcador=0;
if(isset($_GET['idembarcador']))
    $idembarcador = $_GET['idembarcador'];

$idtransportador=0;
if(isset($_GET['idtransportador']))
    $idtransportador = $_GET['idtransportador'];

$idfrete=0;
if(isset($_GET['idfrete']))
    $idfrete = $_GET['idfrete'];


$idveiculo=0;
if(isset($_GET['idveiculo']))
    $idveiculo = $_GET['idveiculo'];


$transacao->setIdfrete($idfrete);
$transacao->setIdembarcador($idembarcador);
$transacao->setIdtransportador($idtransportador);
$transacao->setPreco(0);
$transacao->setChat("");
$transacao->setIdveiculo($idveiculo);

$idtransacao=$transacaoDB->inserir($transacao);

$_SESSION['idtransacao']= $idtransacao;

$tracking->setIdtransacao($idtransacao);
$tracking->setStatus(Utils::$status_transacao[1]);
$tracking->setDataTracking(date('Y-m-d H:i:s'));
$trackingDB->inserir($tracking);

header("Location: ../view/chat.php");


?>