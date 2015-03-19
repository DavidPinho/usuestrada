

function cadastra_veiculo(){

    $('#form_veiculo').attr('action','../control/cadastra_veiculo.php');
    $('#form_veiculo').ajaxForm({

        success : onSuccessCadastraVeiculo
    });


}


function onSuccessCadastraVeiculo(response){

    alert(response);

    var jsonResponse =JSON.parse(response);

    if(jsonResponse.op_code=="erro"){

        resetForm();

        for(var i=0;i<jsonResponse.list_error.length;i++){
            var aux=jsonResponse.list_error[i].split(";");

            reportErroField(aux[0],aux[1]);

        }
    }else{
        window.location="home.php";
    }
}