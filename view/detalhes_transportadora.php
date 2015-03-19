<?php
session_start();

if(empty($_SESSION['idempresa'])){
    header("Location: login.php");
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
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/usuestrada.css" rel="stylesheet">

    <!-- JavaScript -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/modern-business.js"></script>
    <script src="../js/control_request/seleciona_estados.js"></script>
    <script src="../js/control_request/carrega_cidades_origem.js"></script>
    <script src="../js/control_request/carrega_cidades.js"></script>



    <script type="text/javascript">

        function abrirModal(){
            $('#freteModal').modal('show');
        }

        function adicionaEstado (id,uf){
            $('#list_estado_origem').append("<option value=\""+id+"\">"+uf+"</option>");
            $('#list_estado_destino').append("<option value=\""+id+"\">"+uf+"</option>");

        }


        function adicionaCidadeOrigem(id, nome){
            $('#list_cidades_origem').append("<option value=\""+id+"\">"+nome+"</option>");

        }

        function adicionaCidade(id, nome){
            $('#list_cidades').append("<option value=\""+id+"\">"+nome+"</option>");

        }

        $(document).ready(function() {

            document.getElementById("txt_detalhes").value= "";


            seleciona_estados(adicionaEstado, "../control/seleciona_estados.php");

            $('#btn_limpar').click(function(){
                document.getElementById("list_cidades").options.length=0;
                document.getElementById("list_cidades_origem").options.length=0;
            });


        });



    </script>

</head>

<body>

<?php require_once 'contents/top.php';

      include_once '../model/empresaDB.php';
      include_once '../model/veiculoDB.php';
      include_once '../model/cidadeDB.php';
      include_once '../model/freteDB.php';
      include_once '../model/veiculo.php';
      include_once '../model/empresa.php';
      include_once '../model/cidade.php';
      include_once '../model/frete.php';
      include_once '../php_utils/utils.php';

      $veiculo = new Veiculo();
      $veiculoDB= new VeiculoDB();
      $empresa = new Empresa();
      $empresaDB = new EmpresaDB();
      $cidadeDB = new CidadeDB();
      $cidade= new Cidade();
      $frete = new Frete();
      $freteDB = new FreteDB();

      $cidade_origem = new Cidade();
      $cidade_destino= new Cidade();



      $idveiculo=0;
      if(isset($_GET['idveiculo']))
          $idveiculo=$_GET['idveiculo'];

      $idempresa=0;
      if(isset($_GET['idempresa']))
          $idempresa=$_GET['idempresa'];

      $veiculo = $veiculoDB->selecionaVeiculoById($idveiculo);
      $empresa = $empresaDB->selecionaEmpresaById($idempresa);

      $cidade= $cidadeDB->selecionaUma($empresa->getCidade());

      $idembarcador=$_SESSION['idempresa'];
      $idtransportador= $empresa->getIdempresa();

      $fretes = $freteDB->selecionaFretesByEmpresa($idembarcador);

 ?>



<!-- Page Content -->
<div class="container">



     <!-- Page Heading/Breadcrumbs -->
    <div class="row">

        <div class="col-lg-12">
            <h1 class="font-comics page-header"><?php echo $empresa->getNomeCompleto()." (".$cidade->getNome()."-".$cidade->getUf().")";?></h1>
        </div>
    </div>
    <!-- /.row -->

    <!-- Portfolio Item Row -->
    <div class="row">
        <?php
        if(isset($_GET['erro'])){ ?>
        <div class="alert alert-danger alert-dismissible" id="alerta_erro" role="alert" style="margin:15px">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            Por favor, Preencha <strong>todos</strong> os campos do frete!
        </div>
        <?php }?>
        <div class="col-md-8">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img class="img-responsive" src="../img/slide0.jpg" alt="">
                    </div>
                    <div class="item">
                        <img class="img-responsive" src="../img/slide0.jpg" alt="">
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $empresa->getNomeCompleto();?></h3>
                </div>

                <ul class="list-group">
                    <li class="list-group-item text-left">
                        <?php
                           echo "<p>".$empresa->getEndereco().", ".$empresa->getBairro().",  ".$empresa->getCep().
                                 "<br>".$cidade->getNome()."-".$cidade->getUf().", Brasil</p>";
                           echo '<p><i class="fa fa-phone"></i><abbr title="Phone"></abbr> ' .$empresa->getTelefone()."</p>";
                           echo '<p><i class="fa fa-phone"></i><abbr title="Phone"></abbr> ' .$empresa->getCelular()."</p>";
                           echo '<p><i class="fa fa-envelope-o"></i><abbr title="Email"></abbr> ' .$empresa->getEmail()."</p>";
                        ?>
                    </li>
                    <li class="list-group-item" style="font-size: 18px"><strong>Veículo</strong></li>
                    <li class="list-group-item text-left">
                        <strong>Tipo:</strong> <?php echo $veiculo->getTipo(); ?><br>
                        <strong>Carroceria:</strong> <?php echo $veiculo->getCarroceria(); ?><br>
                        <strong>Marca:</strong> <?php echo $veiculo->getMarca(); ?><br>
                        <strong>Modelo:</strong> <?php echo $veiculo->getModelo();?><br>
                        <strong>Ano:</strong> <?php echo $veiculo->getAno(); ?><br>
                        <strong>Rastreador:</strong> <?php echo $veiculo->getRastreador(); ?><br>
                    </li>

                    <li class="list-group-item"><button id="btn_cadastrar"  onclick="abrirModal()" class="btn btn-success btn-lg" ><i class="icon-hand-right"></i>Contactar Transportadora</button>
                    </li>
                 </ul>
            </div>
        </div>

    </div>
    <!-- /.row -->

    <!-- Related Projects Row -->
    <div class="row">

        <div class="col-lg-12">
            <h3 class="page-header font-comics">Sugestão de transportadoras</h3>
        </div>

        <div class="col-sm-3 col-xs-6">
            <a href="#">
                <img class="img-responsive img-hover img-related" src="http://placehold.it/500x300" alt="">
            </a>
        </div>

        <div class="col-sm-3 col-xs-6">
            <a href="#">
                <img class="img-responsive img-hover img-related" src="http://placehold.it/500x300" alt="">
            </a>
        </div>

        <div class="col-sm-3 col-xs-6">
            <a href="#">
                <img class="img-responsive img-hover img-related" src="http://placehold.it/500x300" alt="">
            </a>
        </div>

        <div class="col-sm-3 col-xs-6">
            <a href="#">
                <img class="img-responsive img-hover img-related" src="http://placehold.it/500x300" alt="">
            </a>
        </div>

    </div>
    <!-- /.row -->

<?php require_once 'contents/footer.php';?>


     <div class="modal fade" id="freteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                     <h4 class="modal-title" id="myModalLabel">Escolha um Frete ou <a href="cadastra_frete.php">Cadastre</a> um novo!</h4>
                 </div>

                 <div class="modal-body" style="max-height:300px; overflow-y: auto">


                     <div class="list-group">
                         <div class="list-group-item active" style="background-color: #428BCA; color: #FFF">
                             <span class="glyphicon glyphicon-gift"></span> Seus Fretes
                         </div>
                         <?php

                         for($i=0; $i<count($fretes);$i++){
                             $cidade_origem=  $cidadeDB->selecionaUma($fretes[$i]->getCidadeOrigem());
                             $cidade_destino=  $cidadeDB->selecionaUma($fretes[$i]->getCidadeDestino());
                             echo('<a href="../control/cadastra_transacao.php?idembarcador='.$idembarcador.'&idtransportador='.$idtransportador.'&idfrete='.$fretes[$i]->getIdfrete().'&idveiculo='.$idveiculo.'" class="list-group-item">'.$cidade_origem->getNome().'-'.$cidade_origem->getUf().' -> '.$cidade_destino->getNome().'-'.$cidade_destino->getUf().'<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tipo:</strong> '.Utils::$carga[$fretes[$i]->getTipo()].' </a>');
                         }
                         ?>

                     </div>


                 </div>

                 <div class="modal-footer">
                     <a href="cadastra_frete.php" class="btn btn-success" role="button">Cadastrar Novo Frete</a>
                 </div>

             </div>
         </div>
     </div>


</body>

</html>
