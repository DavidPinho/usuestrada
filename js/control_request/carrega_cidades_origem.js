

function carrega_cidades_origem(estado){

    $.ajax({
        type:"POST",
        url: "../control/carrega_cidades.php",
        data: {codEstado:estado},
        success: onSuccessCarregaCidadesOrigem
    });

}


function onSuccessCarregaCidadesOrigem(response){

    cidades=JSON.parse(response);
    document.getElementById("list_cidades_origem").options.length=0;
    for (var i = 0; i < cidades.length; i++) {
        var cidade=JSON.parse(cidades[i]);
        adicionaCidadeOrigem(cidade.id,cidade.nome);
    }

}