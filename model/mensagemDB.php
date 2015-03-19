<?php

include_once 'baseModel.php';
include_once 'mensagem.php';


Class MensagemDB extends  BaseModel{




    public function __construct(){
        parent::__construct();
    }

    public function inserir(Mensagem $mensagem){

        try{
            if( $this->connection ){

                $stmt = $this->connection->prepare("INSERT INTO mensagem (idtransacao, idempresa, texto) VALUES (:idtransacao, :idempresa, :texto)");

                $stmt->bindParam(':idtransacao', $mensagem->getIdtransacao());
                $stmt->bindParam(':idempresa', $mensagem->getIdempresa());
                $stmt->bindParam(':texto', $mensagem->getTexto());


                $stmt->execute();

                $result=$this->connection->lastInsertId();

            }
        } catch(PDOException $e){
            echo $e->getMessage();
        }

        return $result;


    }



    public function selecionaMensagensByIdTransacao($id){

        $mensagens = array();
        $i=0;

        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM mensagem WHERE idtransacao = :id");
                $stmt->bindParam(':id', $id);

                $stmt->execute();


                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($objs as $obj){
                    $mensagem = new Mensagem();
                    $mensagem->setIdtransacao($obj['idtransacao']);
                    $mensagem->setIdempresa($obj['idempresa']);
                    $mensagem->setIdmensagem($obj['idmensagem']);
                    $mensagem->setTexto($obj['texto']);
                    $mensagem->setDataHora($obj['data_hora']);
                    $mensagens[$i]= $mensagem;
                    $i++;

                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $mensagens;

    }




}



?>