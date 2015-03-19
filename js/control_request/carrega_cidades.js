

function carrega_cidades(estado){

    $.ajax({
        type:"POST",
        url: "../control/carrega_cidades.php",
        data: {codEstado:estado},
        success: onSuccessCarregaCidades
    });

}


function onSuccessCarregaCidades(response){

    cidades=JSON.parse(response);
    document.getElementById("list_cidades").options.length=0;
    for (var i = 0; i < cidades.length; i++) {
        var cidade=JSON.parse(cidades[i]);
        adicionaCidade(cidade.id,cidade.nome);
    }

}