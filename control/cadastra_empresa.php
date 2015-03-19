<?php


    include_once '../model/empresa.php';
    include_once '../model/empresaDB.php';
    include_once '../php_utils/ImageUtils.php';

    $empresa = new Empresa();
    $list_erro_return= array();
    $erro_count =0;
    $empresaDB = new empresaDB();

    $cpf_bool = trim($_POST['cpf_bool']);
    $cnpj_bool = trim($_POST['cnpj_bool']);

    $cpf="";
    $cnpj="";
    $nome="";
    $razao_social="";
    $nome_fantasia="";


    if($cpf_bool){
        $cpf= trim($_POST['txt_cnpj']);
        $nome= trim($_POST['txt_nome']);
        if(empty($nome)||$nome==''){
            $list_erro_return[$erro_count]="nome;"."Informe nome";
            $erro_count++;
        }
    }

    if($cnpj_bool){
        $cnpj= trim($_POST['txt_cnpj']);
        $razao_social= trim($_POST['txt_razao_social']);
        $nome_fantasia=trim($_POST['txt_nome_fantasia']);
        if(empty($razao_social)||$razao_social==''){
            $list_erro_return[$erro_count]="razao_social;"."Informe Razão Social";
            $erro_count++;
        }
        if(empty($nome_fantasia)||$nome_fantasia==''){
            $list_erro_return[$erro_count]="nome_fantasia;"."Informe Nome Fantasia";
            $erro_count++;
        }
    }

    if(!$cpf_bool && !$cnpj_bool){
        $list_erro_return[$erro_count]="cnpj;"."Informe CNPJ ou CPF";
        $erro_count++;
    }

    $endereco = trim($_POST['txt_endereco']);
    if(empty($endereco)||$endereco==''){
        $list_erro_return[$erro_count]="endereco;"."Informe Endereço";
        $erro_count++;
    }


    $email = trim($_POST['txt_email']);
    if(empty($email)||$email==''){
        $list_erro_return[$erro_count]="email;"."Informe Email";
        $erro_count++;
    }elseif(!$empresaDB->checaEmail($email)){
        $list_erro_return[$erro_count]="email;"."Email já cadastrado!";
        $erro_count++;
    }

    $nomeUsuario = trim($_POST['txt_nome_usuario']);
    if(empty($nomeUsuario)||$nomeUsuario==''){
        $list_erro_return[$erro_count]="nome_usuario;"."Informe Nome de Usuário";
        $erro_count++;
    }

    $senha = trim($_POST['txt_senha']);
    if(empty($senha)||$senha==''){
        $list_erro_return[$erro_count]="senha;"."Informe Senha";
        $erro_count++;
    }elseif(strlen($senha)<8){
        $list_erro_return[$erro_count]="senha;"."Mínimo de 8 caracteres";
        $erro_count++;
    }

    $confirmarSenha = trim($_POST['txt_confirmar_senha']);
    if(empty($confirmarSenha)||$confirmarSenha==''){
        $list_erro_return[$erro_count]="confirmar_senha;"."Confirme a senha";
        $erro_count++;
    }elseif($confirmarSenha!=$senha){
        $list_erro_return[$erro_count]="confirmar_senha;"."Confirmação Incorreta!";
        $erro_count++;
    }

    $cep = trim($_POST['txt_cep']);
    if(empty($cep)||$cep==''){
        $list_erro_return[$erro_count]="cep;"."Informe CEP";
        $erro_count++;
    }

    $estado = trim($_POST['list_estado']);
    if(empty($estado)||$estado==0){
        $list_erro_return[$erro_count]="list_estado;"."Selecione";
        $erro_count++;
    }

    $tipo = trim($_POST['list_tipo']);
    if(empty($tipo)||$tipo==0){
        $list_erro_return[$erro_count]="list_tipo;"."Selecione";
        $erro_count++;
    }
    if($tipo==2)
        $tipo= 0;



    $icon_path="";
    if(!empty($_FILES['img_logo'])){
        $icon_path=ImageUtils::createAndValidateIcon($_FILES['img_logo']);
        if($icon_path=="denied")
            $icon_path="";

    }

    if($erro_count>0){
        $form_return=array("op_code"=>"erro","list_error"=>$list_erro_return);
        echo json_encode($form_return);
        return;
    }


    $bairro = trim($_POST['txt_bairro']);
    $celular =trim($_POST['txt_celular']);
    $telefone=trim($_POST['txt_telefone']);
    $complemento=trim($_POST['txt_complemento']);
    $cidade= trim($_POST['list_cidades']);

    $empresa->setEstado($estado);
    $empresa->setNomeUsuario($nomeUsuario);
    $empresa->setBairro($bairro);
    $empresa->setCelular($celular);
    $empresa->setTelefone($telefone);
    $empresa->setCpf($cpf);
    $empresa->setCnpj($cnpj);
    $empresa->setNomeFantasia($nome_fantasia);
    $empresa->setRazaoSocial($razao_social);
    $empresa->setNomeCompleto($nome);
    $empresa->setCidade($cidade);
    $empresa->setEndereco($endereco);
    $empresa->setComplemento($complemento);
    $empresa->setCep($cep);
    $empresa->setEmail($email);
    $empresa->setSenha($senha);
    $empresa->setLogo($icon_path);
    $empresa->setTipoEmpresa($tipo);


    $result = $empresaDB->insert($empresa);

    $form_return=array("op_code"=>"success","new_id"=>$result);

    session_start();
    $_SESSION['idempresa'] = $result;
    $_SESSION['username'] = $empresa->getNomeUsuario();
    $_SESSION['tipo'] = $empresa->getTipoEmpresa();

    echo json_encode($form_return);





?>