<?php


include_once 'baseModel.php';
include_once 'frete.php';

Class FreteDB extends BaseModel{

    public function __construct(){
        parent::__construct();
    }

    public function insert(Frete $frete){

        try{
            if( $this->connection ){

                $stmt = $this->connection->prepare("INSERT INTO frete (idempresa,tipo, detalhes, estado_origem,cidade_origem,
                estado_destino, cidade_destino) VALUES (:idempresa, :tipo, :detalhes, :estado_origem, :cidade_origem,
                :estado_destino, :cidade_destino)");

                $stmt->bindParam(':idempresa', $frete->getIdempresa());
                $stmt->bindParam(':tipo', $frete->getTipo());
                $stmt->bindParam(':detalhes', $frete->getDetalhes());
                $stmt->bindParam(':estado_origem', $frete->getEstadoOrigem());
                $stmt->bindParam(':cidade_origem', $frete->getCidadeOrigem());
                $stmt->bindParam(':estado_destino', $frete->getEstadoDestino());
                $stmt->bindParam(':cidade_destino', $frete->getCidadeDestino());


                $stmt->execute();

                $result=$this->connection->lastInsertId();

            }
        } catch(PDOException $e){
            echo $e->getMessage();
        }

        return $result;

    }

    public function buscaFretes($cidade_origem, $estado_origem,$cidade_destino, $estado_destino,$tipo_produto,$offset, $itemsPorPag){

        $i=0;
        $fretes= array();
        try{
            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM frete inner join empresa on empresa.idempresa = frete.idempresa
                where frete.cidade_origem in (select id from cad_cidades where nome like '%".$cidade_origem."%') and
                frete.estado_origem in (select estado from cad_cidades where uf like '%".$estado_origem."%') and
                frete.cidade_destino in (select id from cad_cidades where nome like '%".$cidade_destino."%') and
                frete.estado_destino in (select estado from cad_cidades where uf like '%".$estado_destino."%') and
                frete.tipo like '%".$tipo_produto."%' limit ".$offset.",".$itemsPorPag);

                $stmt->execute();

                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($objs as $obj){
                    $frete =new Frete();
                    $frete->setIdfrete($obj['idfrete']);
                    $frete->setIdempresa($obj['idempresa']);
                    $frete->setTipo($obj['tipo']);
                    $frete->setDetalhes($obj['detalhes']);
                    $frete->setEstadoOrigem($obj['estado_origem']);
                    $frete->setCidadeOrigem($obj['cidade_origem']);
                    $frete->setEstadoDestino($obj['estado_destino']);
                    $frete->setCidadeDestino($obj['cidade_destino']);
                    $fretes[$i] = $frete;

                    $i++;
                }

            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $fretes;

    }


    public function contaFretes($cidade_origem, $estado_origem,$cidade_destino, $estado_destino,$tipo_produto){

        $total=0;
        try{
            if($this->connection){
                $stmt = $this->connection->prepare("SELECT count(*) FROM frete inner join empresa on empresa.idempresa = frete.idempresa
                where frete.cidade_origem in (select id from cad_cidades where nome like '%".$cidade_origem."%') and
                frete.estado_origem in (select estado from cad_cidades where uf like '%".$estado_origem."%') and
                frete.cidade_destino in (select id from cad_cidades where nome like '%".$cidade_destino."%') and
                frete.estado_destino in (select estado from cad_cidades where uf like '%".$estado_destino."%') and
                frete.tipo like '%".$tipo_produto."%'");

                $stmt->execute();
                $total= $stmt->fetchColumn();
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $total;

    }


    public function selecionaFreteById($id){

        $frete= new Frete();

        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM frete WHERE idfrete = :id");
                $stmt->bindParam(':id', $id);

                $stmt->execute();


                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($objs as $obj){
                    $frete->setIdfrete($obj['idfrete']);
                    $frete->setIdempresa($obj['idempresa']);
                    $frete->setTipo($obj['tipo']);
                    $frete->setDetalhes($obj['detalhes']);
                    $frete->setEstadoOrigem($obj['estado_origem']);
                    $frete->setCidadeOrigem($obj['cidade_origem']);
                    $frete->setEstadoDestino($obj['estado_destino']);
                    $frete->setCidadeDestino($obj['cidade_destino']);

                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $frete;

    }


    public function selecionaFretesByEmpresa($id){

        $fretes= array();
        $i=0;

        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM frete WHERE idempresa = :id");
                $stmt->bindParam(':id', $id);

                $stmt->execute();


                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($objs as $obj){
                    $frete = new Frete();
                    $frete->setIdfrete($obj['idfrete']);
                    $frete->setIdempresa($obj['idempresa']);
                    $frete->setTipo($obj['tipo']);
                    $frete->setDetalhes($obj['detalhes']);
                    $frete->setEstadoOrigem($obj['estado_origem']);
                    $frete->setCidadeOrigem($obj['cidade_origem']);
                    $frete->setEstadoDestino($obj['estado_destino']);
                    $frete->setCidadeDestino($obj['cidade_destino']);
                    $fretes[$i]= $frete;

                    $i++;

                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $fretes;

    }


    public function contaEncomendasByEmp($idempresa){

        $total=0;
        try{
            if($this->connection){
                $stmt = $this->connection->prepare("SELECT count(idempresa) FROM frete where idempresa =".$idempresa);

                $stmt->execute();
                $total= $stmt->fetchColumn();
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $total;

    }


    public function selecionaEncomendaByEmp($idempresa,$offset, $itemsPorPag){

        $i=0;
        $fretes= array();
        try{
            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM frete where idempresa =".$idempresa." limit ".$offset.",".$itemsPorPag);

                $stmt->execute();

                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($objs as $obj){
                    $frete =new Frete();
                    $frete->setIdfrete($obj['idfrete']);
                    $frete->setIdempresa($obj['idempresa']);
                    $frete->setTipo($obj['tipo']);
                    $frete->setDetalhes($obj['detalhes']);
                    $frete->setEstadoOrigem($obj['estado_origem']);
                    $frete->setCidadeOrigem($obj['cidade_origem']);
                    $frete->setEstadoDestino($obj['estado_destino']);
                    $frete->setCidadeDestino($obj['cidade_destino']);
                    $fretes[$i] = $frete;

                    $i++;
                }

            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $fretes;

    }




}










?>