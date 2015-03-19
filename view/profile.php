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
    <link href="../css/usuestrada.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- JavaScript -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/modern-business.js"></script>
    
</head>

<body>

    <?php
    require_once 'contents/top.php';

    include_once  '../model/empresa.php';
    include_once  '../model/empresaDB.php';

    $idempresa=0;

    if(isset($_SESSION['idempresa'])){
        $idempresa=$_SESSION['idempresa'];
    }

    $empresa =new Empresa();
    $empresaDB = new EmpresaDB();

    $empresa = $empresaDB->selecionaEmpresaById($idempresa);

    $logo = "../img/frete1.jpg";

    ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-3 p-photo-square-logo " style="margin-left: 18px; background-image:url(../img/transportadora_tab.png)">

            </div>
            <div class="col-lg-9">
                <h1 class="page-header" >
                    <?php echo $empresa->getNomeCompleto(); ?>
                </h1>

            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <?php
            require_once 'contents/sidebar_profile.php';

            ?>
            <!-- Content Column -->
            <div class="col-md-3">
                <div class="p-unit">
                    <div class="p-photo-circle p-photo3">
                        <div class="p-hover-circle">
                            <div class="p-social">
                                <a href="lista_transacoes.php">
                                    Entrar
                                </a>
                            </div>
                        </div>
                    </div>
                    <span class="p-name">Minhas Transações</span>
                </div>
            </div>
            <?php

            if($_SESSION["tipo"]){ ?>
                <div class="col-md-3">
                    <div class="p-unit">
                        <div class="p-photo-circle p-photo1">
                            <div class="p-hover-circle">
                                <div class="p-social">
                                    <a href="lista_veiculo_perfil.php">
                                        Entrar
                                    </a>
                                </div>
                            </div>
                        </div>
                        <span class="p-name">Meus Veículos</span>
                    </div>
                </div>
            <?php
            }
            else{ ?>
                <div class="col-md-3">
                    <div class="p-unit">
                        <div class="p-photo-circle p-photo2">
                            <div class="p-hover-circle">
                                <div class="p-social">
                                    <a href="lista_encomenda.php">
                                        Entrar
                                    </a>
                                </div>
                            </div>
                        </div>
                        <span class="p-name">Minhas Encomendas</span>
                    </div>
                </div>
            <?php } ?>


            <div class="col-md-3">
                <div class="p-unit">
                    <div class="p-photo-circle p-photo4">
                        <div class="p-hover-circle">
                            <div class="p-social">
                                <a href="home.php">
                                    Entrar
                                </a>
                            </div>
                        </div>
                    </div>
                    <span class="p-name">Editar Perfil</span>
                </div>
            </div>

        </div>
        <!-- /.row -->

     <?php require_once 'contents/footer.php';?>   

</body>

</html>
