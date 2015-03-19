<?php

include_once '../model/empresa.php';
include_once '../model/empresaDB.php';




$list_erro_return= array();
$erro_count =0;
$empresaDB = new EmpresaDB();



$email = trim($_POST['txt_email']);
if(empty($email)||$email==''){
    $list_erro_return[$erro_count]="email;"."Digite seu email ou usuário";
    $erro_count++;
}


$senha = trim($_POST['txt_senha']);
if(empty($senha)||$senha==''){
    $list_erro_return[$erro_count]="senha;"."Informe sua senha";
    $erro_count++;
}

if($erro_count==0){
    $empresa = new Empresa();

    $empresa = $empresaDB->autenticaLogin($email,$senha);

    if($empresa->getIdempresa()!=null){
        session_start();
        $_SESSION['idempresa'] = $empresa->getIdempresa();
        $_SESSION['username'] = $empresa->getNomeUsuario();
        $_SESSION['tipo'] = $empresa->getTipoEmpresa();
        $form_return=array("op_code"=>"success");
        echo json_encode($form_return);
    }else{
        $list_erro_return[$erro_count]="email;"."Email ou senha incorreto!";
        $erro_count++;
        $list_erro_return[$erro_count]="senha;"."Email ou senha incorreto!";
        $erro_count++;
    }
}

if($erro_count>0){
    $form_return=array("op_code"=>"erro","list_error"=>$list_erro_return);
    echo json_encode($form_return);
    return;
}


?>