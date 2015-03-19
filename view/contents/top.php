<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
                <a href="home.php"><img src="../img/logo.png" class="img-responsive"></a>
               
            </div>
			
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php

                    if(empty($_SESSION['idempresa'])){
                    ?>
                    <li><a href="home.php">Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Frete</a>
                        <ul class="dropdown-menu">
                            <li><a href="lista_frete.php">Listar</a></li>
                            <li><a href="cadastra_frete.php">Cadastrar</a></li>
                        </ul>
                    </li>
                    <li><a href="about.php">Sobre</a></li>
                    <li><a href="contact.php">Contato</a></li>
                    <li><div ><a  class="btn btn-success" style="margin-top:8px;margin-left:10px" href="cadastra_empresa.php">Cadastrar</a></div></li>
                    <li><div ><a  class="btn btn-primary" style="margin-top:8px;margin-left:10px" href="login.php">Entrar</a></div></li>
                    <?php
                    }else{

                    echo '
                    <li><a href="home.php">Home</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="lista_transacoes.php">Transações</a></li> ';

                    if($_SESSION['tipo']==1){

                      echo '
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Meus Veículos</a>
                            <ul class="dropdown-menu">
                                <li><a href="lista_veiculo_perfil.php">Listar</a></li>
                                <li><a href="cadastra_veiculo.php">Cadastrar</a></li>
                            </ul>
                        </li> ';
                    }else{
                       echo '
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Minhas Encomendas</a>
                        <ul class="dropdown-menu">
                            <li><a href="lista_encomenda_perfil.php">Listar</a></li>
                            <li><a href="cadastra_frete.php">Cadastrar</a></li>
                        </ul>
                    </li> ';


                    }

                    echo '
                    <li><a href="about.php">Sobre</a></li>
                    <li><a href="contact.php">Contato</a></li>
                    <li><div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" style="margin-top:8px;margin-left:10px" data-toggle="dropdown">
                            Olá, '.$_SESSION["username"].' <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="logout.php">Logout</a></li>
                        </ul>
                      </div></li>';
                    }
                    ?>
                </ul>
                                   
                    
            </div>
            <!-- /.navbar-collapse -->
        </div>
        
        <!-- /.container -->
    </nav>