<?php


$idtransacao=0;
if(isset($_GET['idtransacao'])){
    $idtransacao = $_GET['idtransacao'];
    session_start();
    $_SESSION['idtransacao']=$idtransacao;
    header("Location:../view/chat.php");

}else{
    header("Location:../view/profile.php");

}








?>