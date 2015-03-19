/**
 * Created by david on 10/11/14.
 */


function atualiza_preco(){

    $('#form_preco').attr('action','../control/atualiza_preco.php');
    $('#form_preco').ajaxForm({

        success : onSuccessAtualizaPreco
    });


}


function onSuccessAtualizaPreco(response){

    alert(response);

}