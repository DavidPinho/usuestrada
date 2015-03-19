<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 19/08/14
 * Time: 02:14
 */


include_once 'cidade.php';
include_once 'baseModel.php';

Class CidadeDB extends BaseModel{


    public function __construct(){
        parent::__construct();
    }

    public function selecionaPorEstado($estado){

        $cidades = array();
        $i=0;
        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM cad_cidades WHERE estado = :estado ORDER BY nome");
                $stmt->bindParam(':estado', $estado);
                $stmt->execute();

                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($objs as $obj){
                    $cidade =new Cidade();
                    $cidade->setId($obj["id"]);
                    $cidade->setUf($obj["uf"]);
                    $cidade->setEstado($obj["estado"]);
                    $cidade->setNome($obj["nome"]);
                    $cidades[$i] = $cidade;

                    $i++;
                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $cidades;
    }


    public function selecionaUma($id){


        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM cad_cidades WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $cidade =new Cidade();
                foreach ($objs as $obj){

                    $cidade->setId($obj["id"]);
                    $cidade->setUf($obj["uf"]);
                    $cidade->setEstado($obj["estado"]);
                    $cidade->setNome($obj["nome"]);

                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $cidade;
    }



    public function selecionaTodas(){

        $cidades = array();
        $i=0;
        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM cad_cidades ORDER BY nome");

                $stmt->execute();

                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($objs as $obj){
                    $cidade =new Cidade();
                    $cidade->setId($obj["id"]);
                    $cidade->setUf($obj["uf"]);
                    $cidade->setEstado($obj["estado"]);
                    $cidade->setNome($obj["nome"]);
                    $cidades[$i] = $cidade;

                    $i++;
                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $cidades;
    }




}


?>


