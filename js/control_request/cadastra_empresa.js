

function cadastra_empresa(){


    $('#form_empresa').attr('action','../control/cadastra_empresa.php');
    $('#form_empresa').ajaxForm({

        success : onSuccessCadastraEmpresa
    });


}


function onSuccessCadastraEmpresa(response){

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