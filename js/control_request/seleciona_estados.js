
var callBack;

function seleciona_estados(callBackParam, URL){

    $.ajax({
        url: URL,

        success: onSuccessSelecionaEstados
    });


    callBack=callBackParam;

}


function onSuccessSelecionaEstados(response){

    estados=JSON.parse(response);

    for (var i = 0; i < estados.length; i++) {
        var estado=JSON.parse(estados[i]);
        callBack(estado.id,estado.uf);
    }

}