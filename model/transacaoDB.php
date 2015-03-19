<?php


include_once 'baseModel.php';
include_once 'transacao.php';


Class TrancasacaoDB extends BaseModel{


    public function __construct(){
        parent::__construct();
    }

    public function inserir(Transacao $transacao){

        try{
            if( $this->connection ){

                $stmt = $this->connection->prepare("INSERT INTO transacao (idtransportador, idembarcador, idfrete, preco, chat, idveiculo) VALUES (:idtransportador, :idembarcador, :idfrete, :preco, :chat, :idveiculo)");

                $stmt->bindParam(':idtransportador', $transacao->getIdtransportador());
                $stmt->bindParam(':idembarcador', $transacao->getIdembarcador());
                $stmt->bindParam(':idfrete', $transacao->getIdfrete());
                $stmt->bindParam(':preco',$transacao->getPreco() );
                $stmt->bindParam(':chat', $transacao->getChat());
                $stmt->bindParam(':idveiculo', $transacao->getIdveiculo());

                $stmt->execute();

                $result=$this->connection->lastInsertId();

            }
        } catch(PDOException $e){
            echo $e->getMessage();
        }

        return $result;


    }



    public function selecionaTransacaoById($id){

        $transacao = new Transacao();

        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM transacao WHERE idtransacao = :id");
                $stmt->bindParam(':id', $id);

                $stmt->execute();


                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($objs as $obj){
                    $transacao->setIdtransacao($obj['idtransacao']);
                    $transacao->setIdembarcador($obj['idembarcador']);
                    $transacao->setIdtransportador($obj['idtransportador']);
                    $transacao->setIdfrete($obj['idfrete']);
                    $transacao->setChat($obj['chat']);
                    $transacao->setPreco($obj['preco']);
                    $transacao->setIdveiculo($obj['idveiculo']);
                    $transacao->setStatus($obj['status']);

                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $transacao;

    }


    public function selecionaTodasByEmpId($id, $offset, $itemsPorPag){

        $transacoes= array();
        $i=0;

        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM transacao WHERE idtransportador = :id or idembarcador = :id2 limit ".$offset.",".$itemsPorPag);
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':id2', $id);

                $stmt->execute();


                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($objs as $obj){
                    $transacao = new Transacao();
                    $transacao->setIdtransacao($obj['idtransacao']);
                    $transacao->setIdembarcador($obj['idembarcador']);
                    $transacao->setIdtransportador($obj['idtransportador']);
                    $transacao->setIdfrete($obj['idfrete']);
                    $transacao->setChat($obj['chat']);
                    $transacao->setPreco($obj['preco']);
                    $transacao->setIdveiculo($obj['idveiculo']);
                    $transacao->setStatus($obj['status']);
                    $transacoes[$i]=$transacao;
                    $i++;
                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $transacoes;

    }




    public function contaTransacoes($id){

        $total=0;
        try{
            if($this->connection){

                $stmt = $this->connection->prepare("SELECT count(idtransacao) FROM transacao WHERE idtransportador = :id or idembarcador = :id2");
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':id2', $id);

                $stmt->execute();

                $total= $stmt->fetchColumn();
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $total;

    }

}





?>
