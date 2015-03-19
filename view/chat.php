<?php
session_start();

if(empty($_SESSION['idempresa'])){
    header("Location: login.php");
}

if(empty($_SESSION['idtransacao'])){
    header("Location: home.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>USUESTRADA - Ligando dono de cargas a transportadores</title>
	<link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="../css/modern-business.css" rel="stylesheet">
    <link href="../css/usuestrada.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- JavaScript -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.form.js"></script>
    <script src="../js/modern-business.js"></script>
    <script src="../js/control_request/atualiza_preco.js"></script>
    <script src="../js/control_request/erro_utils.js"></script>



    <script type="text/javascript">


        function abrirConfirmaModal(){
            $('#confirmaModal').modal('show');
        }

        function informaPreco(){
            atualiza_preco();
        }


        function carregaChat(){
            $('#chat_body').load('../control/carrega_chat.php');
            var height = document.getElementById("chat_body").scrollHeight;
            $("#chat_body").animate({ scrollTop: height + 50}, 'normal');
        }

        $(document).ready(function() {

            $.ajaxSetup({cache:false});
            setInterval(carregaChat(), 2000);

            $("#btn_chat").click(function(){
                var msg = $("#txt_msg").val();
                $.post("../control/envia_mensagem_chat.php", {texto: msg});
                $("#txt_msg").val("");
                carregaChat();
                return false;
            });

        });



    </script>
    
</head>

<body>

    <?php

    require_once 'contents/top.php';
    include_once '../model/veiculo.php';
    include_once '../model/veiculoDB.php';
    include_once '../model/empresa.php';
    include_once '../model/empresaDB.php';
    include_once '../model/frete.php';
    include_once '../model/freteDB.php';
    include_once '../model/cidadeDB.php';
    include_once '../model/cidade.php';
    include_once '../model/transacao.php';
    include_once '../model/transacaoDB.php';


    $idtransacao = $_SESSION['idtransacao'];
    $transacao = new Transacao();
    $transacaoDB = new TrancasacaoDB();
    $transacao = $transacaoDB->selecionaTransacaoById($idtransacao);



    $idfrete=$transacao->getIdfrete();
    $freteDB = new FreteDB();
    $frete = new Frete();
    $frete= $freteDB->selecionaFreteById($idfrete);

    $idveiculo = $transacao->getIdveiculo();
    $veiculoDB = new VeiculoDB();
    $veiculo= new Veiculo();
    $veiculo = $veiculoDB->selecionaVeiculoById($idveiculo);

    $idembarcador = $transacao->getIdembarcador();
    $empresaDB = new EmpresaDB();
    $empresa =  new Empresa();
    $embarcador =  new Empresa();
    $embarcador= $empresaDB->selecionaEmpresaById($idembarcador);

    $idtransportador = $transacao->getIdtransportador();
    $transportador =  new Empresa();
    $transportador= $empresaDB->selecionaEmpresaById($idtransportador);

    $isFrete=0;
    $idempresa=$_SESSION['idempresa'];

    $cidade_origem= new Cidade();
    $cidade_destino=new Cidade();
    $cidade_empresa=new Cidade();
    $cidadeDB = new CidadeDB();

    if($idempresa==$embarcador->getIdempresa()){
        $empresa = $transportador;
    }elseif($idempresa==$transportador->getIdempresa()){
        $empresa=$embarcador;
        $cidade_origem= $cidadeDB->selecionaUma($frete->getCidadeOrigem());
        $cidade_destino= $cidadeDB->selecionaUma($frete->getCidadeDestino());
        $isFrete=1;
    }

    $cidade_empresa= $cidadeDB->selecionaUma($empresa->getCidade());

    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8" style="left: 0%; padding-top: 60px">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-comment"></span> Chat
                    </div>

                    <div id="chat_body" class="panel-body" style="overflow-y: scroll; height: 320px;">

                    </div>
                    <div class="panel-footer">
                        <form id="mensagem_form" name="mensagem_form" action="">
                            <div class="input-group">
                                <input id="txt_msg" name="txt_msg" class="form-control input-sm" placeholder="Digite sua mensagem..." type="text">
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm" id="btn_chat">
                                    Enviar</button>
                            </span>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-md-4" style="margin-top:60px">
                <div class="panel panel-primary text-center">
                    <div class="panel-heading">
                        <?php
                          if($isFrete)
                            echo '<h3 class="panel-title">FRETE</h3>';
                          else
                            echo '<h3 class="panel-title">VEÍCULO</h3>';
                        ?>
                    </div>
                    <ul class="list-group">
                        <?php
                        if($isFrete){
                        ?>
                            <li class="list-group-item text-left">
                                <strong>Tipo: </strong> <?php echo $frete->getTipo(); ?><br>
                                <strong>Detalhes: </strong> <?php echo $frete->getDetalhes(); ?><br>
                                <strong>Origem:</strong> <?php echo $cidade_origem->getNome()."-".$cidade_origem->getUf(); ?><br>
                                <strong>Destino:</strong> <?php echo $cidade_destino->getNome()."-".$cidade_destino->getUf(); ?><br>
                            </li>
                            <?php }else{ ?>
                            <li class="list-group-item text-left">
                                <strong>Tipo:</strong> <?php echo $veiculo->getTipo(); ?><br>
                                <strong>Carroceria:</strong> <?php echo $veiculo->getCarroceria(); ?><br>
                                <strong>Marca:</strong> <?php echo $veiculo->getMarca(); ?><br>
                                <strong>Modelo:</strong> <?php echo $veiculo->getModelo();?><br>
                                <strong>Ano:</strong> <?php echo $veiculo->getAno(); ?><br>
                                <strong>Rastreador:</strong> <?php echo $veiculo->getRastreador(); ?><br>
                            </li>
                            <?php } ?>
                        <li class="list-group-item" style="font-size: 17px"><strong>Empresa</strong></li>
                        <li class="list-group-item text-left">
                            <?php
                            echo "<p>".$empresa->getNomeCompleto()."</p>";
                            echo "<p>".$empresa->getEndereco().", ".$empresa->getBairro().",  ".$empresa->getCep().
                                "<br>".$cidade_empresa->getNome()."-".$cidade_empresa->getUf().", Brasil</p>";
                            echo '<p><i class="fa fa-phone"></i><abbr title="Phone"></abbr> ' .$empresa->getTelefone()."</p>";
                            echo '<p><i class="fa fa-phone"></i><abbr title="Phone"></abbr> ' .$empresa->getCelular()."</p>";
                            echo '<p><i class="fa fa-envelope-o"></i><abbr title="Email"></abbr> ' .$empresa->getEmail()."</p>";
                            ?>
                        </li>
                    </ul>

                </div>
                <div id="chat-footer" style="text-align: center">
                    <button id="btn_cadastrar"  onclick="abrirConfirmaModal()" class="btn btn-success" ><i class="icon-hand-right"></i>Confirmar Transação</button>
                    <button id="btn_cancelar"   class="btn btn-danger" ><i class="icon-hand-right"></i>Cancelar Transação</button>
                </div>
            </div>



        </div>
    </div>

    <!-- /.container -->

     <?php require_once 'contents/footer.php';?>

    <div class="modal fade" id="confirmaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog center-modal">
            <div class="modal-content" style="width: 500px">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Informe o preço da transação para confirmar operação</h4>
                </div>

                <div class="modal-body">
                  <form id="form_preco" name="form_preco" method="post" role="form">
                    <div id="control_preco" class=" form-group padding-modal" style="padding-left: 5px;padding-bottom: 30px" >
                        <label for="txt_preco" class="col-md-2 control-label" id="lbl_preco">Preço: </label>
                        <div class="col-md-7">
                            <input id="txt_preco"  name="txt_preco" class="form-control" rows="3">
                        </div>
                        <div class="col-md-3">
                            <button id="btn_confirma_preco"  onclick="informaPreco()" class="btn btn-info" >Enviar</button>
                        </div>
                    </div>
                  </form>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
