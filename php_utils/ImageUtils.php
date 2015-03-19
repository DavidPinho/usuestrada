<?php


class ImageUtils{

    public static function createAndValidateIcon($icon){

        $allowedExts = array("jpg", "jpeg", "gif", "png");
        $iconImage = explode(".", $icon["name"]);
        $extension = end($iconImage);

        if($icon == NULL){
            return "none";
        }elseif ((($icon["type"] == "image/gif")
                || ($icon["type"] == "image/jpeg")
                || ($icon["type"] == "image/png")
                || ($icon["type"] == "image/pjpeg"))
            && in_array($extension, $allowedExts)){

            do{
                $filename=uniqid().".".$extension;
            }while(file_exists("../img/logo/".$filename));

            move_uploaded_file($icon["tmp_name"],"../img/logo/".$filename);
            return 	$filename;

        }else{
            return "denied";
        }
    }

}


?>