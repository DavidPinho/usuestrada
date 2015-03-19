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
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

    <!-- JavaScript -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.form.js"></script>
    <script src="../js/modern-business.js"></script>
    <script src="../js/control_request/seleciona_estados.js"></script>
    <script src="../js/control_request/carrega_cidades_origem.js"></script>
    <script src="../js/control_request/carrega_cidades.js"></script>
    <script src="../js/control_request/cadastra_frete.js"></script>
    <script src="../js/control_request/erro_utils.js"></script>



    <script type="text/javascript">

        var test =1;

        function clickSave(){

            cadastra_frete();
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


        function resetForm(){
            $("#control_tipo").removeClass("has-error");
            $("#control_detalhes").removeClass("has-error");
            $("#control_estado_origem").removeClass("has-error");
            $("#control_estado_destino").removeClass("has-error");


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

<?php require_once 'contents/top.php';?>
<?php include_once '../php_utils/utils.php' ?>


<div class="container">



    <div id="cadastra_frete_box" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Cadastrar Frete</div>
            </div>
            <div class="panel-body" >
                <form id="form_frete" class="form-horizontal" method="post" role="form">
                    <input id="id_empresa" name="id_empresa" type="hidden" />


                    <div id="control_tipo" class="form-group">
                            <label for="list_tipo" class="col-md-3 control-label" id="lbl_tipo">Tipo de Carga</label>
                            <div class="col-md-7">
                                <select id="list_tipo" name="list_tipo" class="form-control">
                                    <option value="0">Selecione</option>
                                    <?php
                                    for($i=1; $i<=count(Utils::$carga);$i++){
                                        echo('<option value="'.$i.'">'.Utils::$carga[$i].'</option>');
                                    }
                                    ?>
                                </select>
                            </div>
                    </div>

                    <div id="control_detalhes" class=" form-group">
                        <label for="txt_detalhes" class="col-md-3 control-label" id="lbl_detalhes">Detalhes</label>
                        <div class="col-md-9">
                            <textarea id="txt_detalhes"  name="txt_detalhes" class="form-control" rows="3"></textarea>
                        </div>
                    </div>


                    <div class="form-group"  id="control_estado_origem">
                        <label for="list_estado_origem" id="lbl_estado_origem" class="col-md-3 control-label">Origem</label>
                        <div class="col-md-4" >
                            <select id="list_estado_origem" name="list_estado_origem"  onchange="carrega_cidades_origem(this.value)" class="form-control">
                                <option value="0">Estado</option>
                            </select>
                        </div>
                        <div  class="col-md-5">
                            <select class="form-control" name="list_cidades_origem" id="list_cidades_origem">
                                <option value="0">Cidade</option>"
                            </select>
                        </div>
                    </div>


                    <div class="form-group"  id="control_estado_destino">
                        <label for="list_estado_destino" id="lbl_estado_destino" class="col-md-3 control-label">Destino</label>
                        <div class="col-md-4" >
                            <select id="list_estado_destino" name="list_estado_destino"  onchange="carrega_cidades(this.value)" class="form-control">
                                <option value="0">Estado</option>
                            </select>
                        </div>
                        <div  class="col-md-5">
                            <select class="form-control" name="list_cidades" id="list_cidades">
                                <option value="0">Cidade</option>"
                            </select>
                        </div>
                    </div>




                    <div class="form-group" style="border-top: 1px solid#888; padding-top:20px">
                        <button id="btn_limpar" type="reset" class="btn btn-default col-md-offset-2 col-md-3"  style="color:white; background-color:gray"><i class="icon-hand-right"></i>Limpar</button>
                        <button id="btn_cadastrar"  onclick="clickSave()" class="btn btn-success col-md-offset-1 col-md-4"><i class="icon-hand-right"></i>Cadastrar</button>

                    </div>


                </form>
            </div>
        </div>


    </div>


</div>


<?php require_once 'contents/footer.php';?>


</body>

</html>
