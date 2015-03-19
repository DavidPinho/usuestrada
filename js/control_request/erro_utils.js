function reportErroField(id,message){

    if(id.substr(0,5)=="list_"){
        id = id.substr(5);
    }else{
        $("#txt_"+id).attr("placeholder", message);
        document.getElementById("txt_"+id).value="";
    }

	
	$("#control_"+id).addClass("has-error");
	
}