<?php


include_once "../model/empresa.php";
include_once "../model/empresaDB.php";
include_once "../model/mensagem.php";
include_once "../model/mensagemDB.php";


session_start();

if(isset($_SESSION['idempresa'])& isset($_SESSION['idtransacao'])){

    $idempresa = $_SESSION['idempresa'];
    $idtransacao = $_SESSION['idtransacao'];

    $empresa_logada= new Empresa();
    $empresa_mensagem = new Empresa();
    $empresaDB = new EmpresaDB();
    $mensagem = new Mensagem();
    $mensagemDB = new MensagemDB();

    $imagem="../img/encomenda_chat.jpg";

    $empresa_logada = $empresaDB->selecionaEmpresaById($idempresa);
    $mensagens = array();
    $mensagens = $mensagemDB->selecionaMensagensByIdTransacao($idtransacao);

    echo '<ul class="chat">';

    for($i=0; $i<count($mensagens);$i++){

        $empresa_mensagem = $empresaDB->selecionaEmpresaById($mensagens[$i]->getIdempresa());
        $data_sistema = new DateTime();
        $data_mensagem = date("d-m-Y", strtotime($mensagens[$i]->getDataHora()));
        $hora_mensagem = date("(H:i)", strtotime($mensagens[$i]->getDataHora()));



        if($empresa_mensagem->getTipoEmpresa()){
            $imagem= "../img/transportadora_tab.png";
        }else{
            $imagem="../img/encomenda_chat.jpg";
        }

        echo '  <li class="left clearfix"><span class="chat-img pull-left">
                    <img src="'.$imagem.'">
                </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">'.$empresa_mensagem->getNomeUsuario().'</strong> <small class="pull-right text-muted">
                                    <span class="glyphicon glyphicon-time"></span>'.$data_mensagem.'<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$hora_mensagem.'</small>
                            </div>
                            <p>'
                                .$mensagens[$i]->getTexto().
                            '</p>
                        </div>
                    </li>';





    }

    echo  '</ul>';



}







?>