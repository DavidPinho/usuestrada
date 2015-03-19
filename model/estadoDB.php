<?php

include_once 'baseModel.php';
include_once 'estado.php';

Class EstadoDB extends BaseModel{



    public function __construct(){
        parent::__construct();
    }

    public function selectAll(){

        $estados = array();
        $i=0;
        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM cad_estados ORDER BY uf");
                $stmt->execute();

                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($objs as $obj){
                    $estado =new Estado();
                    $estado->setId($obj["id"]);
                    $estado->setUf($obj["uf"]);
                    $estado->setNome($obj["nome"]);
                    $estados[$i] = $estado;

                    $i++;
                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $estados;
    }

    public function existeEstado($estado_nome){

        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT uf FROM cad_estados where nome='".$estado_nome."';");
                $stmt->execute();

                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($objs as $obj){
                    return $obj["uf"];
                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return "erro";
    }




}


?>