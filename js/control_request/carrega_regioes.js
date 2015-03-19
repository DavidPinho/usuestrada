

function carrega_regioes(){


    $.ajax({

        url:'../control/carrega_regioes.php',
        success: function(response){
            addRegiao(JSON.parse(response));

        }

    });

}