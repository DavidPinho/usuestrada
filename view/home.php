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
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/usuestrada.css" rel="stylesheet">
    
    <!-- JavaScript -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/typeahead.bundle.js"></script>
    <script src="../js/modern-business.js"></script>
    <script src="../js/control_request/carrega_regioes.js"></script>
    <script src="../js/control_request/busca_transportadora.js"></script>
    <script src="../js/js_utils/remove_diacritics.js"></script>



    <script type="text/javascript">


        function buscaTransportadora(){
            busca_transportadora();
        }

        var regioes = ['Brasil'];


        function addRegiao(list_regioes){

           for(i = regioes.length  ; i<=list_regioes.length; i++){
                regioes[i]= list_regioes[i-1];
           }

        }


        var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substrRegex;
                q = remove_diacritics(q);
                // an array that will be populated with substring matches
                matches = [];

                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');

                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function(i, str) {
                    str=remove_diacritics(str);
                    if (substrRegex.test(str)) {
                // the typeahead jQuery plugin expects suggestions to a
                // JavaScript object, refer to typeahead docs for more info
                        matches.push({ value: str });
                    }
                });

                cb(matches);
            };
        };


        $(document).ready(function() {

            carrega_regioes();


            $("#txt_regiao").typeahead({
                    hint: false,
                    highlight: true,
                    minLength: 3
                },
                {
                    name: 'regioes',
                    displayKey: 'value',
                    source: substringMatcher(regioes)
                });
            $("#txt_origem").typeahead({
                    hint: false,
                    highlight: true,
                    minLength: 3
                },
                {
                    name: 'regioes',
                    displayKey: 'value',
                    source: substringMatcher(regioes)
                });
            $("#txt_destino").typeahead({
                    hint: false,
                    highlight: true,
                    minLength: 3
                },
                {
                    name: 'regioes',
                    displayKey: 'value',
                    source: substringMatcher(regioes)
                });
        });



    </script>
       

</head>

<body>


    <?php require_once 'contents/top.php';?>
    <?php include_once '../php_utils/utils.php' ?>

    

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('../img/slide1.png');"></div>
                <div class="carousel-caption">
                   <h2><a href="home.php">Cadastre</a> seu veículo e encontre cargas para transportar</h2>	
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('../img/slide2.jpg');"></div>
                <div class="carousel-caption">
                    <h1>Encontre um transportador para sua carga <a href="home.php">aqui</a></h1>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </div>


    <div class="container">
        <div class="section">   
            <div class="well">
                        <!-- Service Tabs -->
                <div class="row text-center">
                    <div class="col-lg-12">
                        <ul id="myTab" class="nav nav-tabs nav-justified" style="font-size:20px">
                            <li class="active"><a href="#transportadora_form" data-toggle="tab">Buscar Transportadora <img src="../img/transportadora_tab.png"></a>
                            </li>
                            <li class=""><a href="#frete_form" data-toggle="tab">Buscar Frete <img src="../img/frete_tab.png"></a>
                            </li>
                        </ul>

                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in" id="transportadora_form">
                                <form id="form_busca_transportadora" action="lista_transportadora.php" method="get" class="form-inline" role="form">

                                    <div id="control_regiao" class="form-group">
                                        <img src="../img/location-small.png" title="Região">                                        
                                        <input type="text" class="typeahead form-control text-center" id="txt_regiao" name="txt_regiao" placeholder="Estado ou Cidade">
                                    </div> 
                                    <div id="control_nome_transportadora" class="form-group">
                                      <label style="font-size:16px; font-weight:normal;margin-left:10px" for="txt_nome_transportadora">Nome:</label>
                                      <input id="txt_nome_transportadora" name="txt_nome_transportadora" placeholder="Nome da transportadora" class="form-control typeahead text-center" type="text">
                                    </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
                                    <div id="control_tipo" class="form-group">
                                        <label for="list_tipo" style="font-size:16px; font-weight:normal;margin-left:10px">Tipo de veículo:</label>
                                        <select id="list_tipo" name="list_tipo" class="form-control">
                                             <option>Todos</option>
                                             <option>Rodotrem</option>
                                             <option>Bitrem</option>                                             
                                        </select>                                  
                                    </div>
                                    <div class="form-group" style="margin-left:20px">                                    
                                    <button id="btn_busca_transportadora" name="btn_busca_transportadora" type="submit" class="btn btn-success btn-large">Buscar <span class="glyphicon glyphicon-search"></span></button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="frete_form">
                                <form id="form_busca_frete" class="form-inline" action="lista_frete.php" method="get" role="form">
                                    <div class="form-group">
                                        <img src="../img/location-small.png" title="Origem">                                        
                                        <input type="text" class="typeahead text-center form-control" id="txt_origem" name="txt_origem" placeholder="Região de Origem">
                                    </div>                                
                                    <div class="form-group" style="margin-left:20px">                                        
                                        <img src="../img/location-small.png" title="Destino">                                        
                                        <input type="text" class="form-control typeahead text-center" id="txt_destino" name="txt_destino" placeholder="Região de Destino">
                                    </div> 
                                    <div class="form-group">
                                        <label for="list_tipo_produto" style="font-size:16px; font-weight:normal;margin-left:10px">Tipo do Produto:</label>
                                        <select id="list_tipo_produto" name="list_tipo_produto" class="form-control">
                                             <option value="0">Todos</option>
                                             <?php
                                             for($i=1; $i<=count(Utils::$carga);$i++){
                                                 echo('<option value="'.$i.'">'.Utils::$carga[$i].'</option>');
                                             }
                                             ?>
                                        </select>                                  
                                    </div> 
                                    <div class="form-group" style="margin-left:20px">                                    
                                    <button type="submit" class="btn btn-success btn-large">Buscar <span class="glyphicon glyphicon-search"></span></button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>

                    </div>
                </div>
           </div>     
        </div>
        

        <div class="row">
          
            <div class="col-md-4 col-sm-6">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <img src="../img/logo.png">
                    </div>
                    <div class="panel-body">
                        <h4>Serviço Um</h4>
                        <p>Fazer detalhamento sobre algum serviço oferecido pela plataforma.</p>
                        <a href="#" class="btn btn-primary">Leia Mais</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <img src="../img/logo.png">
                    </div>
                    <div class="panel-body">
                        <h4>Serviço Dois</h4>
                        <p>Fazer detalhamento sobre algum serviço oferecido pela plataforma.</p>
                        <a href="#" class="btn btn-primary">Leia Mais</a>
                    </div>
                </div>
             </div>
            <div class="col-md-4 col-sm-6">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <img src="../img/logo.png">
                        </div>
                        <div class="panel-body">
                            <h4>Serviço Três</h4>
                            <p>Fazer detalhamento sobre algum serviço oferecido pela plataforma.</p>
                            <a href="#" class="btn btn-primary">Leia Mais</a>
                        </div>
                    </div>
            </div>
        </div>
        <!-- /.row -->


        <div class="section">
            <div class="col-md-4 col-sm-6">
                <div class="ad-single green-ad">
                    Anuncie aqui
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="ad-single blue-adv  ">
                    Anuncie aqui
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="ad-single green-ad">
                    Anuncie aqui
                </div>
            </div>

        </div>
           
	</div>
    
    <?php require_once 'contents/footer.php';?>
    
    
</body>

</html>
