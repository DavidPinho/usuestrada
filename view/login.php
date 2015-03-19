<?php
session_start();
if(!empty($_SESSION["idempresa"]))
  header("Location: home.php");
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
    
    <!-- JavaScript -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.form.js"></script>
    <script src="../js/modern-business.js"></script>
    <script src="../js/control_request/logar.js"></script>
    <script src="../js/control_request/erro_utils.js"></script>


    <script type="text/javascript">


        function clickLogar(){
            logar();
        }

        function resetForm(){
            $("#control_senha").removeClass("has-error");
            $("#control_email").removeClass("has-error");
        }

    </script>

    <?php

    if(!(empty($_SESSION['empresa'])))
        header("Location: home.php")
    ?>

</head>

<body>

    <?php require_once 'contents/top.php';?>


    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Login</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Esqueceu sua senha?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="form_login" class="form-horizontal" method="post" role="form">
                                    
                            <div id="control_email" style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="txt_email" type="text" class="form-control" name="txt_email" value="" placeholder="usuário ou email">
                                    </div>
                                
                            <div id="control_senha" style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="txt_senha" type="password" class="form-control" name="txt_senha" placeholder="senha">
                                    </div>
                                                                    

                             <div style="margin-top:10px" class="form-group">
                                <!-- Button -->

                                <div class="col-md-5">
                                    <button id="btn_logar"  onclick="clickLogar()" class="btn btn-success">Entrar no Sistema</button>
                                </div>

                                <div class="col-md-7">
                                    Não é cadastrado?
                                     <a  class="btn btn-default"  href="cadastra_empresa.php">Cadastre-se já!</a>
                                </div>


                            </div>

                            
                        </form>     



                        </div>                     
                    </div>  
        </div>

    </div>
    

    <?php require_once 'contents/footer.php';?>
    
    
</body>

</html>
