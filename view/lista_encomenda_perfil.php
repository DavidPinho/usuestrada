<?php session_start();

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
    <link href="../css/usuestrada.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

    <!-- JavaScript -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.form.js"></script>
    <script src="../js/modern-business.js"></script>

    <script type="text/javascript">


        $(document).ready(function() {

            $('[data-toggle="tooltip"]').tooltip();


        });


    </script>


</head>

<body>

<?php

require_once 'contents/top.php';
include_once '../php_utils/utils.php';
include_once '../model/empresa.php';
include_once '../model/empresaDB.php';
include_once '../model/cidade.php';
include_once '../model/cidadeDB.php';
include_once '../model/estadoDB.php';
include_once '../model/frete.php';
include_once '../model/freteDB.php';




$encomendas = array();

$encomenda = new Frete();
$freteDB = new FreteDB();

$cidade_origem = new Cidade();
$cidade_destino = new Cidade();
$cidadeDB = new CidadeDB();


$idempresa = $_SESSION['idempresa'];
$totalItens = $freteDB->contaEncomendasByEmp($idempresa);

$itemsPorPag = 15;

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


$encomendas=$freteDB->selecionaEncomendaByEmp($idempresa,$offset, $itemsPorPag);

?>



<div class="container">

    <div class="row" style="margin-top: 20px;">

        <h2>Minhas Encomendas</h2>

        <table id="table_encomendas" class="table table-bordered table-striped text-center" style="margin-top: 20px;">
            <thead>
            <tr>
                <th class="text-center">Tipo</th>
                <th class="text-center">Detalhes</th>
                <th class="text-center">Origem -> Destino</th>
                <th class="text-center"><a href="cadastra_frete.php" class="badge" style="background-color:green" data-toggle="tooltip" data-placement="top" data-original-title="Cadastrar">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo</a>
                </th>
            </tr>
            </thead>

            <tbody>
            <?php
            for($i=0; $i<count($encomendas); $i++){

                $encomenda = $encomendas[$i];
                $cidade_origem = $cidadeDB->selecionaUma($encomenda->getCidadeOrigem());
                $cidade_destino = $cidadeDB->selecionaUma($encomenda->getCidadeDestino());


                echo '<tr>';
                echo '<td>'.Utils::$carga[$encomenda->getTipo()].'</td>';
                echo '<td>'.$encomenda->getDetalhes().'</td>';

                echo '<td>'.$cidade_origem->getNome().'-'.$cidade_origem->getUf().' -> '.$cidade_destino->getNome().'-'.$cidade_destino->getUf().'</td>';
                echo '<td> <a href="#" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="Atualizar">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                               <a href="#" class="btn btn-danger btn-xs" style="margin-left: 4px" data-toggle="tooltip" data-placement="top" data-original-title="Remover">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                          </td>';
                echo '</tr>';

            }?>

            </tbody>

        </table>

    </div>



    <hr>


    <div class="row text-center">

        <ul class="pagination">
            <?php
            $range = 3;

            // if not on page 1, don't show back links
            if ($paginaAtual > 1) {
                // show << link to go back to page 1
                echo "<li><a href='{$_SERVER['PHP_SELF']}?paginaAtual=1'><<</a></li>";
                // get previous page num
                $paginaAnterior = $paginaAtual - 1;
                // show < link to go back to 1 page
                echo "<li><a href='{$_SERVER['PHP_SELF']}?paginaAtual=$paginaAnterior'><</a></li> ";
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
                        echo "<li><a href='{$_SERVER['PHP_SELF']}?paginaAtual=$x'>$x</a></li> ";
                    } // end else
                } // end if
            } // end for

            // if not on last page, show forward and last page links
            if ($paginaAtual != $totalPaginas and $totalPaginas!=0) {
                // get next page
                $proximaPagina = $paginaAtual + 1;
                // echo forward link for next page
                echo " <li><a href='{$_SERVER['PHP_SELF']}?paginaAtual=$proximaPagina'>></a></li> ";
                // echo forward link for lastpage
                echo " <li><a href='{$_SERVER['PHP_SELF']}?paginaAtual=$totalPaginas'>>></a> </li>";
            } // end if
            /****** end build pagination links ******/

            ?>

        </ul>

    </div>




</div>


<?php require_once 'contents/footer.php';?>


</body>

</html>

