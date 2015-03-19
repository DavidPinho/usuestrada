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
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    
    <!-- JavaScript -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.form.js"></script>
    <script src="../js/modern-business.js"></script>
    <script src="../js/fileinput.min.js" type="text/javascript"></script>
    <script src="../js/control_request/seleciona_estados.js"></script>
    <script src="../js/control_request/carrega_cidades.js"></script>
    <script src="../js/control_request/cadastra_empresa.js"></script>
    <script src="../js/control_request/erro_utils.js"></script>






    <script type="text/javascript">


    function clickSave(){

        cadastra_empresa();
    }



    function resetForm(){
        $("#control_cnpj").removeClass("has-error");
        $("#control_nome_fantasia").removeClass("has-error");
        $("#control_nome").removeClass("has-error");
        $("#control_razao_social").removeClass("has-error");
        $("#control_estado").removeClass("has-error");
        $("#control_tipo").removeClass("has-error");
        $("#control_endereco").removeClass("has-error");
        $("#control_cep").removeClass("has-error");
        $("#control_email").removeClass("has-error");
        $("#control_nome_usuario").removeClass("has-error");
        $("#control_senha").removeClass("has-error");
        $("#control_confirmar_senha").removeClass("has-error");

    }

    function adicionaEstado(id,uf){
        $('#list_estado').append("<option value=\""+id+"\">"+uf+"</option>");

    }


    function adicionaCidade(id, nome){
        $('#list_cidades').append("<option value=\""+id+"\">"+nome+"</option>");

    }

    function verificaCpfCnpj(){
      if(validarCpf()){
          document.getElementById("lbl_nome").style.display = "block";
          document.getElementById("txt_nome").style.display = "block";

          document.getElementById("cpf_bool").value= 1;
      }else{
          document.getElementById("lbl_nome").style.display = "none";
          document.getElementById("txt_nome").style.display = "none";

          document.getElementById("cpf_bool").value= 0;
      }

      if(validarCNPJ()){
          document.getElementById("lbl_razao_social").style.display = "block";
          document.getElementById("txt_razao_social").style.display = "block";
          document.getElementById("lbl_nome_fantasia").style.display = "block";
          document.getElementById("txt_nome_fantasia").style.display = "block";

          document.getElementById("cnpj_bool").value=1;
      }else{
          document.getElementById("lbl_razao_social").style.display = "none";
          document.getElementById("txt_razao_social").style.display = "none";
          document.getElementById("lbl_nome_fantasia").style.display = "none";
          document.getElementById("txt_nome_fantasia").style.display = "none";

          document.getElementById("cnpj_bool").value=0;
      }

      if(document.getElementById("cnpj_bool").value==0 &&  document.getElementById("cpf_bool").value==0){
          document.getElementById("txt_cnpj").value="";
          document.getElementById("txt_cnpj").placeholder="CPF ou CNPJ incorreto!";
          var d = document.getElementById("control_cnpj");
          d.className = d.className + " has-error";
      }else{
          document.getElementById("txt_cnpj").placeholder="CPF/CNPJ";
          var d = document.getElementById("control_cnpj");
          d.className="";
          d.className="form-group";
      }

    }

    function validarCpf(){

        cpf = document.getElementById("txt_cnpj").value;
        if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
        return false;
        add = 0;
        for (i=0; i < 9; i ++)
            add += parseInt(cpf.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(9)))
            return false;
        add = 0;
        for (i = 0; i < 10; i ++)
            add += parseInt(cpf.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(10)))
            return false;
        return true;
    }


    function validarCNPJ(){
        cnpj = document.getElementById("txt_cnpj").value;
        cnpj = cnpj.replace(/[^\d]+/g,'');

        if(cnpj == '') return false;

        if (cnpj.length != 14)
            return false;

        // Elimina CNPJs invalidos conhecidos
        if (cnpj == "00000000000000" ||
            cnpj == "11111111111111" ||
            cnpj == "22222222222222" ||
            cnpj == "33333333333333" ||
            cnpj == "44444444444444" ||
            cnpj == "55555555555555" ||
            cnpj == "66666666666666" ||
            cnpj == "77777777777777" ||
            cnpj == "88888888888888" ||
            cnpj == "99999999999999")
            return false;

        // Valida DVs
        tamanho = cnpj.length - 2
        numeros = cnpj.substring(0,tamanho);
        digitos = cnpj.substring(tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
            return false;

        tamanho = tamanho + 1;
        numeros = cnpj.substring(0,tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
            return false;

        return true;

    }


    $(document).ready(function() {

        document.getElementById("cpf_bool").value = 0;
        document.getElementById("cnpj_bool").value = 0;
        document.getElementById("txt_cnpj").value= "";
        document.getElementById("txt_nome").value= "";
        document.getElementById("txt_nome_fantasia").value= "";
        document.getElementById("txt_razao_social").value= "";
        document.getElementById("txt_cnpj").value= "";
        document.getElementById("txt_endereco").value= "";
        document.getElementById("txt_complemento").value= "";
        document.getElementById("txt_bairro").value= "";
        document.getElementById("txt_cep").value= "";
        document.getElementById("txt_email").value= "";
        document.getElementById("txt_telefone").value= "";
        document.getElementById("txt_celular").value= "";
        document.getElementById("txt_nome_usuario").value= "";
        document.getElementById("txt_senha").value= "";
        document.getElementById("txt_confirmar_senha").value= "";

        seleciona_estados(adicionaEstado, "../control/seleciona_estados.php");


        $('#btn_limpar').click(function(){
           document.getElementById("list_cidades").options.length=0;
        });




    });




    </script>
       

</head>

<body>

    <?php require_once 'contents/top.php';?>


    <div class="container">



        <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

                    <div class="alert alert-info">

                        <a href="#" class="close" data-dismiss="alert">&times;</a>

                        Este cadastro é valido tanto para o usuário que possui cargas para serem enviadas quanto para donos de veículos que procuram cargas para transportar.

                    </div>



                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Cadastro</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="login.php">Entrar</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="form_empresa" class="form-horizontal" method="post" role="form">
                                <input id="cpf_bool" name="cpf_bool" type="hidden" />
                                <input id="cnpj_bool" name="cnpj_bool" type="hidden" />
                                <input id="id_empresa" name="id_empresa" type="hidden" />
                                

                                <div id="control_cnpj" class="form-group">
                                    <label for="txt_cnpj" id="lbl_cnpj" class="col-md-3 control-label">CPF/CNPJ</label>
                                    <div class="controls col-md-9">
                                        <input type="text" class="form-control" id="txt_cnpj" name="txt_cnpj" placeholder="CPF/CNPJ" onchange="verificaCpfCnpj()">

                                    </div>
                                </div>

                                <div id="control_nome" class=" form-group">
                                    <label for="txt_nome" class="col-md-3 control-label" id="lbl_nome" style="display: none">Nome</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="txt_nome" name="txt_nome"  style="display: none" placeholder="Nome Completo">
                                    </div>
                                </div>
                                

                                <div id="control_razao_social" class=" form-group">
                                    <label for="txt_razao_social" class="col-md-3 control-label" id="lbl_razao_social" style="display: none">Razão Social</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="txt_razao_social"  id="txt_razao_social" style="display: none" placeholder="Razão Social">
                                    </div>
                                </div>

                                <div id="control_nome_fantasia" class=" form-group">
                                    <label for="txt_nome_fantasia" class="col-md-3 control-label"  id="lbl_nome_fantasia" style="display: none">Nome Fantasia</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="txt_nome_fantasia" id="txt_nome_fantasia" style="display: none" placeholder="Nome Fantasia">
                                    </div>
                                </div>
                                

                                <div class="form-group"  id="control_estado" style="border-top: 1px solid#888; padding-top:20px">
                                        <label for="list_estado" id="lbl_estado" class="col-md-3 control-label">Estado</label>
                                        <div class="col-md-3" >
                                            <select id="list_estado" name="list_estado"  onchange="carrega_cidades(this.value)" class="form-control">
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

                                <div id="control_endereco" class=" form-group">
                                    <label for="txt_endereco" id="lbl_endereco" class="col-md-3 control-label">Endereço</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="txt_endereco" name="txt_endereco" placeholder="Endereço">
                                    </div>                                    
                                </div>

                                <div id="control_complemento" class=" form-group">
                                    <label for="txt_complemento" id="lbl_complemento" class="col-md-3 control-label">Complemento</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="txt_complemento" name="txt_complemento" placeholder="Complemento">
                                    </div>                   
                                </div>

                                <div class="form-group">     
                                    <label for="txt_bairro" id="lbl_bairro" class="col-md-3 control-label">Bairro</label>
                                    <div class="col-md-4 control_bairro">
                                        <input type="text" class="form-control" id="txt_bairro" name="txt_bairro" placeholder="Bairro">
                                    </div>
                                    <label for="txt_cep" id="lbl_cep" class="col-md-2 control-label">CEP</label>
                                    <div class="col-md-3 " id="control_cep">
                                        <input type="text" class="form-control" id="txt_cep" name="txt_cep" placeholder="CEP">
                                    </div>
                                </div>


                                 <div id="control_email" class="form-group " style="border-top: 1px solid#888; padding-top:20px">
                                    <label for="txt_email" id="lbl_email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="txt_email"  id="txt_email" placeholder="Email">
                                    </div>
                                </div>
                                    

                                <div class="form-group">     
                                    <label for="txt_telefone" id="lbl_telefone" class="col-md-3 control-label">Telefone</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="txt_telefone" name="txt_telefone" placeholder="Telefone">
                                    </div>                              
                                    <label for="txt_celular" id="lbl_celular" class="col-md-2     control-label">Celular</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" id="txt_celular" name="txt_celular" placeholder="Celular">
                                    </div>
                                </div>


                                <div id="control_image" class="form-group " style="border-top: 1px solid#888; padding-top:20px">
                                    <label for="txt_image" id="lbl_image" class="col-md-3 control-label">Imagem</label>
                                    <div class="col-md-9">
                                        <input id="img_logo" name="img_logo" type="file" class="file">
                                    </div>
                                </div>

                                <div id="control_tipo" class=" form-group">
                                    <label for="list_tipo" id="lbl_tipo" class="col-md-4 control-label">Tipo de Usuário</label>
                                    <div class="col-md-8" >
                                        <select id="list_tipo" name="list_tipo" class="form-control">
                                            <option value="0">Escolha Tipo</option>
                                            <option value="1">Transportador</option>
                                            <option value="2">Embarcador</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="control_nome_usuario" class="form-group ">
                                    <label for="txt_nome_usuario" id="lbl_nome_usuario" class="col-md-4 control-label">Nome de Usuário</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="txt_nome_usuario" name="txt_nome_usuario" placeholder="Nome de Usuário">
                                    </div>
                                </div>


                                <div id="control_senha" class="form-group ">
                                    <label for="txt_senha" id="lbl_senha" class="col-md-4 control-label">Senha</label>
                                    <div class="col-md-8">
                                        <input type="password" class="form-control" id="txt_senha" name="txt_senha" placeholder="Senha">
                                    </div>
                                </div>

                                <div id="control_confirmar_senha" class="form-group ">
                                    <label for="txt_confirmar_senha" id="lbl_confirmar_senha" class="col-md-4 control-label">Confirmar Senha</label>
                                    <div class="col-md-8">
                                        <input type="password" class="form-control"  id="txt_confirmar_senha" name="txt_confirmar_senha" placeholder="Confirmar Senha">
                                    </div>
                                </div>

                                <div class="form-group" style="border-top: 1px solid#888; padding-top:20px">                              
                                    <button id="btn_limpar" type="reset" class="btn btn-default col-md-offset-3 col-md-3"  style="color:white; background-color:gray"><i class="icon-hand-right"></i>Limpar</button>
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
