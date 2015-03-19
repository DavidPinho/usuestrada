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



    <script type="text/javascript">


        function abrirModal(){
            $('#transportadoraModal').modal('show');
        }


    </script>

</head>

<body>

<?php require_once 'contents/top.php';

      include_once '../model/empresaDB.php';
      include_once '../model/freteDB.php';
      include_once '../model/cidadeDB.php';
      include_once '../model/frete.php';
      include_once '../model/empresa.php';
      include_once '../model/cidade.php';
      include_once '../model/veiculoDB.php';
      include_once '../model/veiculo.php';

      $freteDB = new FreteDB();
      $frete = new Frete();
      $empresa = new Empresa();
      $empresaDB = new EmpresaDB();
      $cidadeDB = new CidadeDB();
      $cidade_origem= new Cidade();
      $cidade_destino = new Cidade();
      $cidade_empresa = new Cidade();
      $veiculoDB = new VeiculoDB();
      $veiculo = new Veiculo();

      $idtransportador=0;
      if(isset($_SESSION['idempresa']))
        $idtransportador = $_SESSION['idempresa'];


      $idfrete=0;
      if(isset($_GET['idfrete']))
          $idfrete=$_GET['idfrete'];


      $frete= $freteDB->selecionaFreteById($idfrete);
      $idempresa = $frete->getIdempresa();
      $empresa = $empresaDB->selecionaEmpresaById($idempresa);


      $cidade_origem= $cidadeDB->selecionaUma($frete->getCidadeOrigem());
      $cidade_destino= $cidadeDB->selecionaUma($frete->getCidadeDestino());
      $cidade_empresa= $cidadeDB->selecionaUma($empresa->getCidade());


      $veiculos = $veiculoDB->selecionaTodosByEmpresa($idtransportador);


?>
<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h3  class="font-comics page-header"><?php echo $cidade_origem->getNome()."-".$cidade_origem->getUf().' -> '.$cidade_destino->getNome()."-".$cidade_destino->getUf();?></h3>
        </div>
    </div>
    <!-- /.row -->

    <!-- Portfolio Item Row -->
    <div class="row">

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
                        <img class="img-responsive" src="../img/frete0.jpg" alt="">
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
                    <h3 class="panel-title">FRETE</h3>
                </div>
                <ul class="list-group">
                    <li class="list-group-item text-left">
                        <strong>Tipo: </strong> <?php echo $frete->getTipo(); ?><br>
                        <strong>Detalhes: </strong> <?php echo $frete->getDetalhes(); ?><br>
                        <strong>Origem:</strong> <?php echo $cidade_origem->getNome()."-".$cidade_origem->getUf(); ?><br>
                        <strong>Destino:</strong> <?php echo $cidade_destino->getNome()."-".$cidade_destino->getUf(); ?><br>
                    </li>
                    <li class="list-group-item" style="font-size: 17px"><strong>Empresa</strong></li>
                    <li class="list-group-item text-left">
                        <?php
                        echo "<p>".$empresa->getEndereco().", ".$empresa->getBairro().",  ".$empresa->getCep().
                            "<br>".$cidade_empresa->getNome()."-".$cidade_empresa->getUf().", Brasil</p>";
                        echo '<p><i class="fa fa-phone"></i><abbr title="Phone"></abbr> ' .$empresa->getTelefone()."</p>";
                        echo '<p><i class="fa fa-phone"></i><abbr title="Phone"></abbr> ' .$empresa->getCelular()."</p>";
                        echo '<p><i class="fa fa-envelope-o"></i><abbr title="Email"></abbr> ' .$empresa->getEmail()."</p>";
                        ?>
                    </li>
                    <li class="list-group-item"><button id="btn_cadastrar"  onclick="abrirModal()" class="btn btn-success btn-lg" ><i class="icon-hand-right"></i>Aceitar Frete</button>
                    </li>
                    <!--<li class="list-group-item"><a href="../control/cadastra_transacao.php?idembarcador=<?php echo $idempresa; ?>&idtransportador=<?php echo $idtransportador; ?>&idfrete=<?php echo $idfrete;?>&idveiculo=6" class="btn btn-success btn-lg ">Aceitar Frete</a>
                    </li> -->
                </ul>

            </div>
        </div>

    </div>
    <!-- /.row -->

    <!-- Related Projects Row -->
    <div class="row">

        <div class="col-lg-12">
            <h3 class="page-header font-comics">Mais Fretes</h3>
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


    <div class="modal fade" id="transportadoraModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Escolha um Veículo ou <a href="cadastra_veiculo.php">Cadastre um novo</a></h4>
                </div>

                <div class="modal-body" style="max-height:300px; overflow-y: auto">


                    <div class="list-group">
                        <div class="list-group-item active" style="background-color: #428BCA; color: #FFF">
                            <span class="glyphicon glyphicon-road"></span> Seus Veiculos
                        </div>
                        <?php
                        for($i=0; $i<count($veiculos);$i++){
                            echo('<a href="../control/cadastra_transacao.php?idembarcador='.$idempresa.'&idtransportador='.$idtransportador.'&idfrete='.$idfrete.'&idveiculo='.$veiculos[$i]->getIdveiculo().'" class="list-group-item"><strong>Modelo:</strong> '.$veiculos[$i]->getMarca().' - '.$veiculos[$i]->getModelo().'<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Placa:</strong> '.$veiculos[$i]->getPlaca().' </a>');
                        }
                        ?>

                    </div>


                </div>

                <div class="modal-footer">
                    <a href="cadastra_veiculo.php" class="btn btn-success" role="button">Cadastrar Novo Veículo</a>
                </div>

            </div>
        </div>
    </div>


</body>

</html>
