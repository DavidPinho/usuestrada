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
<script src="../js/typeahead.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.form.js"></script>
<script src="../js/modern-business.js"></script>
<script src="../js/fileinput.min.js" type="text/javascript"></script>
<script src="../js/control_request/cadastra_veiculo.js"></script>
<script src="../js/control_request/erro_utils.js"></script>
<script src="../js/control_request/seleciona_estados.js"></script>
<script src="../js/control_request/carrega_cidades.js"></script>



<script type="text/javascript">


    function clickSave(){

        cadastra_veiculo();
    }

    function ativa_alerta(){
        $("#alert_regiao").show();
    }


    function resetForm(){
        $("#control_antt").removeClass("has-error");
        $("#control_placa").removeClass("has-error");
        $("#control_marca").removeClass("has-error");
        $("#control_modelo").removeClass("has-error");
        $("#control_ano").removeClass("has-error");
        $("#control_rastreador").removeClass("has-error");
        $("#control_tipo").removeClass("has-error");
        $("#control_carroceria").removeClass("has-error");

    }

    function adicionaEstado(id,uf){
        $('#list_estado').append("<option value=\""+id+"\">"+uf+"</option>");

    }


    function adicionaCidade(id, nome){
        $('#list_cidades').append("<option value=\""+id+"\">"+nome+"</option>");

    }

    $(document).ready(function() {



        //document.getElementById("id_empresa").value = id de empresa logada;
        document.getElementById("list_tipo").value= "0";
        document.getElementById("list_rastreador").value= "2";
        document.getElementById("txt_marca").value= "";
        document.getElementById("txt_modelo").value= "";
        document.getElementById("txt_ano").value= "";
        document.getElementById("txt_placa").value= "";
        document.getElementById("txt_antt").value= "";
        document.getElementById("list_rastreador").value= "1";


        seleciona_estados(adicionaEstado, "../control/seleciona_estados.php");

        $('#alert_regiao').hide();

        $('#btn_limpar').click(function(){
            document.getElementById("list_cidades").options.length=0;
        });


    });




</script>


</head>

<body>

<?php require_once 'contents/top.php';?>
<?php include_once '../php_utils/utils.php' ?>


<div class="container">



    <div id="cadastra_veiculo_box" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3">

        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Cadastro de Veículo</div>
            </div>
            <div class="panel-body" >
                <form id="form_veiculo" class="form-horizontal" method="post" role="form">
                    <input id="id_empresa" name="id_empresa" type="hidden" />


                    <div id="control_antt" class="form-group">
                        <label for="txt_antt" id="lbl_antt" class="col-md-2 control-label">ANTT</label>
                        <div class="controls col-md-10">
                            <input type="text" class="form-control" id="txt_antt" name="txt_antt" placeholder="Código da ANTT" >
                        </div>
                    </div>

                    <div id="control_placa" class=" form-group">
                        <label for="txt_placa" class="col-md-2 control-label" id="lbl_placa">Placa</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="txt_placa" name="txt_placa"  placeholder="Placa">
                        </div>
                    </div>


                    <div class=" form-group">
                        <div id="control_marca">
                            <label for="txt_marca" class="col-md-2 control-label" id="lbl_marca">Marca</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="txt_marca"  id="txt_marca" placeholder="Marca">
                            </div>
                        </div>

                        <div id="control_modelo" >
                            <label for="txt_modelo" class="col-md-2 control-label" id="lbl_modelo">Modelo</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="txt_modelo"  id="txt_modelo" placeholder="Modelo">
                            </div>
                        </div>
                    </div>


                    <div class=" form-group">
                        <div id="control_ano">
                            <label for="txt_ano" class="col-md-2 control-label" id="lbl_ano">Ano</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="txt_ano"  id="txt_ano" placeholder="Ano">
                            </div>
                        </div>

                        <div id="control_rastreador" >
                            <label for="list_rastreador" class="col-md-2 control-label" id="lbl_rastreador">Rastreador</label>
                            <div class="col-md-4">
                                <select id="list_rastreador" name="list_rastreador" class="form-control">
                                    <option value="0">Selecione</option>
                                    <option value="1">Sim</option>
                                    <option value="2">Não</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class=" form-group">

                        <div id="control_tipo" >
                            <label for="list_tipo" class="col-md-2 control-label" id="lbl_tipo">Tipo</label>
                            <div class="col-md-4">
                                <select id="list_tipo" name="list_tipo" class="form-control">
                                    <option value="0">Selecione</option>
                                    <?php
                                        for($i=1; $i<=count(Utils::$tiposVeiculo);$i++){
                                            echo('<option value="'.$i.'">'.Utils::$tiposVeiculo[$i].'</option>');
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div id="control_carroceria" >
                            <label for="txt_carroceria" class="col-md-2 control-label" id="lbl_carroceria">Carroceria</label>
                            <div class="col-md-4">
                                <select id="list_carroceria" name="list_carroceria" class="form-control">
                                    <option value="0">Selecione</option>
                                    <?php
                                    for($i=1; $i<=count(Utils::$carrocerias);$i++){
                                        echo('<option value="'.$i.'">'.Utils::$carrocerias[$i].'</option>');
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="control_image" class="form-group">
                        <label for="txt_image" id="lbl_image" class="col-md-2 control-label">Imagem</label>
                        <div class="col-md-10">
                            <input id="img_logo" name="img_logo" type="file" class="file">
                        </div>
                    </div>

                    <div class=" form-group">
                        <div id="control_status" >
                            <label for="list_status" class="col-md-2 control-label" id="lbl_status">Status</label>
                            <div class="col-md-10">
                                <select id="list_status" onclick="ativa_alerta()"  name="list_status" class="form-control">
                                    <option value="1">Disponível</option>
                                    <option value="2">Ocupado</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"  id="control_estado">
                        <label for="list_estado" id="lbl_estado" class="col-md-2 control-label">Estado</label>
                        <div class="col-md-4" >
                            <select id="list_estado" name="list_estado" onclick="ativa_alerta()"  onchange="carrega_cidades(this.value)" class="form-control">
                                <option value="0">Estado</option>
                            </select>
                        </div>
                        <label for="list_cidades" id="lbl_cidade" class="col-md-2 control-label">Cidade</label>
                        <div  class="col-md-4">
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



    <div id="alert_regiao" class="alert alert-info col-md-3" role="alert" style="margin-top: 37%">
       Os campos de estado e cidade são referentes ao local onde o veículo se encontra no momento.
    </div>


</div>


<?php require_once 'contents/footer.php';?>


</body>

</html>
