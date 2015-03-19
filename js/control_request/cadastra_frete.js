

function cadastra_frete(){


    $('#form_frete').attr('action','../control/cadastra_frete.php');
    $('#form_frete').ajaxForm({

        success : onSuccessCadastraFrete
    });


}


function onSuccessCadastraFrete(response){


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