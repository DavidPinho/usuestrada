<?php
session_start();
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
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

    <!-- JavaScript -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.form.js"></script>
    <script src="../js/modern-business.js"></script>
    <script src="../js/fileinput.min.js" type="text/javascript"></script>

</head>

<body>

    <?php require_once 'contents/top.php';?>
    <?php
          include_once '../model/empresaDB.php';
          include_once '../model/veiculoDB.php';
          include_once '../model/cidadeDB.php';
          include_once '../model/estadoDB.php';
          include_once '../model/veiculo.php';
          include_once '../model/cidade.php';
          include_once '../model/empresa.php';
          include_once '../php_utils/utils.php';


          $estadoDB = new EstadoDB();
          $cidadeDB = new CidadeDB();
          $veiculoDB = new VeiculoDB();
          $empresaDB = new EmpresaDB();

          $regiao="";
          if(isset($_GET["txt_regiao"])){
            $regiao=$_GET["txt_regiao"];
          }

          $empresa_nome="";
          if(isset($_GET["txt_nome_transportadora"]))
            $empresa_nome=$_GET["txt_nome_transportadora"];

          $tipo_veiculo="";
          if(isset($_GET["list_tipo"])){
              if($_GET["list_tipo"]==null or $_GET["list_tipo"]=="Todos")
                $tipo_veiculo="";
              else
                $tipo_veiculo=$_GET["list_tipo"];
          }

          $stringGet = "&txt_regiao=".$regiao."&txt_nome_transportadora=".$empresa_nome."&list_tipo=".$tipo_veiculo;

          $cidade="";
          $estado="";
          if(substr($regiao,-3,-2)=="-"){
              //Busca por cidade usando o Auto-Complete
              $cidade=substr($regiao, 0, -3);
              $estado= substr($regiao, -2);
           }else{
              if($regiao=="Brasil"){
                  //Buscando pelo país inteiro
                  $cidade="";
                  $estado="";
              }else{
                  $resul = $estadoDB->existeEstado($regiao);
                  if($resul!="erro"){
                      //Buscando por estado
                      $cidade="";
                      $estado=$resul;
                  }  else{
                      //Buscando entre todas as cidades, alguma que seja a digitada
                      $cidade=$regiao;
                      $estado="";
                  }
              }
          }


          $totalItens = $veiculoDB->contaVeiculos($cidade, $estado, $empresa_nome,$tipo_veiculo);

          $itemsPorPag = 6;

          $totalPaginas = ceil($totalItens/$itemsPorPag);

          // get the current page or set a default
          if (isset($_GET['paginaAtual']) && is_numeric($_GET['paginaAtual'])) {
            // cast var as int
            $paginaAtual = (int) $_GET['paginaAtual'];
          } else {
            // default page num
              $paginaAtual = 1;
          } // end if

          if ($paginaAtual > $totalPaginas)
            $paginaAtual = $totalPaginas;

          if ($paginaAtual < 1)
            $paginaAtual = 1;


          $offset = ($paginaAtual  - 1) * $itemsPorPag;

          $transportadoras= array();
          $transportadoras=$veiculoDB->buscaVeiculos($cidade, $estado, $empresa_nome,$tipo_veiculo,$offset, $itemsPorPag);

          $numeroItems = sizeof($transportadoras);
          $numeroRows = ceil($numeroItems/3);


          //preenche as rows
          $veiculo = new Veiculo();
          $empresa = new Empresa();
          $city = new Cidade();



    ?>
    <!-- Page Content -->
    <div class="container">

        <div class="border-search text-center" style="margin-top: 35px;">


            <form class="form-inline" role="form">

                <div class="form-group">
                    <img src="../img/location-small.png" title="Região">
                    <input type="text" class="form-control input" id="regiao" placeholder="Região da Transportadora">
                </div>
                <div class="form-group">
                    <label style="font-size:16px; font-weight:normal;margin-left:10px" for="nome_transportadora">Nome:</label>
                    <input id="nome_transportadora" name="nome_transportadora" placeholder="Nome da transportadora" class="form-control input" type="text">
                </div>
                <div class="form-group">
                    <label for="name" style="font-size:16px; font-weight:normal;margin-left:10px">Tipo de veículo:</label>
                    <select class="form-control">
                        <option>Todos</option>
                        <option>Rodotrem</option>
                        <option>Bitrem</option>
                    </select>
                </div>
                <div class="form-group" style="margin-left:20px">
                    <button class="btn btn-success btn-large">Buscar <span class="glyphicon glyphicon-search"></span></button>
                </div>
            </form>


        </div>


        <div class="col-lg-12">
            <h2 class="font-comics page-header">Transportadoras</h2>
        </div>


        <?php
        if($numeroItems==0)
            echo '<div class="alert alert-danger text-center" role="alert">Nenhuma Transportadora encontrada!</div>';
        $k=0;
        for($i=0;$i<$numeroRows;$i++){
        ?>
            <!-- Projects Row -->
            <div class="row">

                <?php
                $j=0;
                while($j<3 and $k<$numeroItems){
                    $veiculo = $transportadoras[$k];
                    $idempresa =$veiculo->getIdempresa();
                    $empresa = $empresaDB->selecionaEmpresaById($idempresa);
                    $city=  $cidadeDB->selecionaUma($empresa->getCidade());
                    $idveiculo =  $veiculo->getIdveiculo();

                    ?>


                <div class="col-md-4">
                    <div class="p-unit" style="margin-bottom: 40px;">
                        <div class="p-photo-square" style="background-image:url(../img/slide<?php echo $k?>.jpg); border: 1px solid">
                            <div class="p-hover-square">
                                <div class="p-social2">
                                    <?php echo "<a href='detalhes_transportadora.php?idempresa=$idempresa&idveiculo=$idveiculo'>";?>
                                    Entrar
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="p-caption-square" style="border:1px solid">
                            <div class="p-caption-font">
                                <a href="detalhes_transportadora.php?idempresa=<?php echo $idempresa."&idveiculo=".$idveiculo?>">
                                <?php echo $empresa->getNomeCompleto()." (".$city->getNome()."-".$city->getUf().")";  ?>
                                </a>
                            </div>
                            <span class="p-caption-font-small">Tipo do Veículo: <?php echo Utils::$tiposVeiculo[$veiculo->getTipo()]; ?></span>
                            <span class="p-caption-font-small">Rating: 100%</span>
                        </div>
                    </div>
                </div>

               <!--<div class="col-md-3 img-portfolio" style="height: 300px; margin-bottom: 15px">
                        <div class="border-img" style="padding: 15px; height: 300px;">
                            <div class="border-img home-ad-box" style="margin-top: 10px;">
                                <?php
                                echo "<a href='detalhes_transportadora.php?idempresa=$idempresa&idveiculo=$idveiculo'>";
                                ?>
                                <img class="img-responsive img-hover" src="../img/slide<?php echo $k?>.jpg" alt="">
                                </a>
                            </div>
                            <div>
                                <p style="font-size: 16px">
                                    <a class="font-comics" href="detalhes_transportadora.php?idempresa=<?php echo $idempresa."&idveiculo=".$idveiculo?>">
                                        <?php echo $empresa->getNomeCompleto()." (".$city->getNome()."-".$city->getUf().")";  ?>
                                    </a>
                                </p>
                                <p style="font-size: 14px">
                                    Tipo do Veículo: <?php echo $veiculo->getTipo(); ?>
                                </p>
                                <p style="font-size: 14px">Rating: 100%</p>
                            </div>
                        </div>
               </div> --!>

                <?php

                     $j++;
                     $k++;
                } ?>

            </div>
            <!-- /.row -->
        <?php
        }
        ?>


        <hr>


        <div class="row text-center">

            <ul class="pagination">
                <?php
                $range = 3;

                // if not on page 1, don't show back links
                if ($paginaAtual > 1) {
                    // show << link to go back to page 1
                    echo "<li><a href='{$_SERVER['PHP_SELF']}?paginaAtual=1$stringGet'><<</a></li>";
                    // get previous page num
                    $paginaAnterior = $paginaAtual - 1;
                    // show < link to go back to 1 page
                    echo "<li><a href='{$_SERVER['PHP_SELF']}?paginaAtual=$paginaAnterior$stringGet'><</a></li> ";
                } // end if


                // loop to show links to range of pages around current page
                for ($x = ($paginaAtual - $range); $x < (($paginaAtual + $range) + 1); $x++) {
                    // if it's a valid page number...
                    if (($x > 0) && ($x <= $totalPaginas)) {
                        // if we're on current page...
                        if ($x == $paginaAtual) {
                            // 'highlight' it but don't make a link
                            echo " <li class='li-pagination'>$x</li> ";
                            // if not current page...
                        } else {
                            // make it a link
                            echo "<li><a href='{$_SERVER['PHP_SELF']}?paginaAtual=$x$stringGet'>$x</a></li> ";
                        } // end else
                    } // end if
                } // end for

                // if not on last page, show forward and last page links
                if ($paginaAtual != $totalPaginas and $totalPaginas!=0) {
                    // get next page
                    $proximaPagina = $paginaAtual + 1;
                    // echo forward link for next page
                    echo " <li><a href='{$_SERVER['PHP_SELF']}?paginaAtual=$proximaPagina$stringGet'>></a></li> ";
                    // echo forward link for lastpage
                    echo " <li><a href='{$_SERVER['PHP_SELF']}?paginaAtual=$totalPaginas$stringGet'>>></a> </li>";
                } // end if
                /****** end build pagination links ******/

                ?>

            </ul>

        </div>


    </div>
    <!-- /.container -->

    <?php require_once 'contents/footer.php';?>

</body>

</html>
