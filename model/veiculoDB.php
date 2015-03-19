<?php


include_once 'baseModel.php';

Class VeiculoDB extends BaseModel{

    public function __construct(){
        parent::__construct();
    }


    public function insert(Veiculo $veiculo){

        try{
            if( $this->connection ){

                $stmt = $this->connection->prepare("INSERT INTO veiculo (idempresa, tipo, carroceria, rastreador, marca,modelo, ano, placa, imagem, antt, status, cidade_disponivel) VALUES (:idempresa, :tipo, :carroceria, :rastreador, :marca,:modelo, :ano, :placa, :imagem,:antt, :status, :cidade_disponivel)");

                $stmt->bindParam(':idempresa', $veiculo->getIdempresa());
                $stmt->bindParam(':tipo', $veiculo->getTipo());
                $stmt->bindParam(':carroceria', $veiculo->getCarroceria());
                $stmt->bindParam(':rastreador', $veiculo->getRastreador());
                $stmt->bindParam(':marca', $veiculo->getMarca());
                $stmt->bindParam(':modelo', $veiculo->getModelo());
                $stmt->bindParam(':ano', $veiculo->getAno());
                $stmt->bindParam(':placa', $veiculo->getPlaca());
                $stmt->bindParam(':imagem', $veiculo->getImagem());
                $stmt->bindParam(':antt', $veiculo->getAntt());
                $stmt->bindParam(':status', $veiculo->getStatus());
                $stmt->bindParam(':cidade_disponivel', $veiculo->getCidadeDisponivel());


                $stmt->execute();

                $result=$this->connection->lastInsertId();

            }
        } catch(PDOException $e){
            echo $e->getMessage();
        }

        return $result;
    }


    public function buscaVeiculos($cidade, $estado,$nome_empresa,$tipo_veiculo,$offset, $itemsPorPag){

        $veiculos = array();

        $i=0;
        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT veiculo.idempresa, veiculo.idveiculo, veiculo.imagem, veiculo.tipo FROM empresa inner join veiculo on empresa.idempresa = veiculo.idempresa
                where empresa.cidade in (select id from cad_cidades where nome like '%".$cidade."%') and
                empresa.estado in (select estado from cad_cidades where uf like '%".$estado."%') and
                (empresa.nome_completo like '%".$nome_empresa."%' or empresa.razao_social like '%".$nome_empresa."%' or empresa.nome_fantasia like '%".$nome_empresa."%') and
                veiculo.tipo like '%".$tipo_veiculo."%' limit ".$offset.",".$itemsPorPag);

                $stmt->execute();

                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($objs as $obj){
                    $veiculo =new Veiculo();
                    $veiculo->setIdveiculo($obj['idveiculo']);
                    $veiculo->setIdempresa($obj['idempresa']);
                    $veiculo->setImagem($obj['imagem']);
                    $veiculo->setTipo($obj['tipo']);
                    $veiculos[$i] = $veiculo;

                    $i++;
                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $veiculos;

    }



    public function contaVeiculos($cidade, $estado,$nome_empresa,$tipo_veiculo){

        $total=0;
        try{
            if($this->connection){
                $stmt = $this->connection->prepare("SELECT count(empresa.idempresa) FROM empresa inner join veiculo on empresa.idempresa = veiculo.idempresa
                where empresa.cidade in (select id from cad_cidades where nome like '%".$cidade."%') and
                empresa.estado in (select estado from cad_cidades where uf like '%".$estado."%') and
                (empresa.nome_completo like '%".$nome_empresa."%' or empresa.razao_social like '%".$nome_empresa."%' or empresa.nome_fantasia like '%".$nome_empresa."%') and
                veiculo.tipo like '%".$tipo_veiculo."%'");

                $stmt->execute();
                $total= $stmt->fetchColumn();
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $total;
    }


    public function contaVeiculosByEmp($id){

        $total=0;
        try{
            if($this->connection){
                $stmt = $this->connection->prepare("SELECT count(idempresa) FROM veiculo where idempresa = ".$id);

                $stmt->execute();
                $total= $stmt->fetchColumn();
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $total;
    }

    public function selecionaTodosByEmpresaPag($id,$offset, $itemsPorPag){

        $veiculos = array();
        $i=0;
        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM veiculo WHERE idempresa = :id limit ".$offset.",".$itemsPorPag);
                $stmt->bindParam(':id', $id);

                $stmt->execute();


                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($objs as $obj){
                    $veiculo = new Veiculo();
                    $veiculo->setIdveiculo($obj['idveiculo']);
                    $veiculo->setIdempresa($obj['idempresa']);
                    $veiculo->setAno($obj['ano']);
                    $veiculo->setAntt($obj['antt']);
                    $veiculo->setCarroceria($obj['carroceria']);
                    $veiculo->setImagem($obj['imagem']);
                    $veiculo->setMarca($obj['marca']);
                    $veiculo->setModelo($obj['modelo']);
                    $veiculo->setPlaca($obj['placa']);
                    $veiculo->setRastreador($obj['rastreador']);
                    $veiculo->setTipo($obj['tipo']);
                    $veiculo->setStatus($obj['status']);
                    $veiculo->setCidadeDisponivel($obj['cidade_disponivel']);
                    $veiculos[$i]=$veiculo;
                    $i++;
                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $veiculos;

    }


    public function selecionaVeiculoById($id){

        $veiculo = new Veiculo();

        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM veiculo WHERE idveiculo = :id");
                $stmt->bindParam(':id', $id);

                $stmt->execute();


                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($objs as $obj){
                    $veiculo->setIdveiculo($obj['idveiculo']);
                    $veiculo->setIdempresa($obj['idempresa']);
                    $veiculo->setAno($obj['ano']);
                    $veiculo->setAntt($obj['antt']);
                    $veiculo->setCarroceria($obj['carroceria']);
                    $veiculo->setImagem($obj['imagem']);
                    $veiculo->setMarca($obj['marca']);
                    $veiculo->setModelo($obj['modelo']);
                    $veiculo->setPlaca($obj['placa']);
                    $veiculo->setRastreador($obj['rastreador']);
                    $veiculo->setTipo($obj['tipo']);
                    $veiculo->setStatus($obj['status']);
                    $veiculo->setCidadeDisponivel($obj['cidade_disponivel']);
                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $veiculo;

    }


    public function selecionaTodosByEmpresa($id){

        $veiculos = array();
        $i=0;
        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM veiculo WHERE idempresa = :id");
                $stmt->bindParam(':id', $id);

                $stmt->execute();


                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($objs as $obj){
                    $veiculo = new Veiculo();
                    $veiculo->setIdveiculo($obj['idveiculo']);
                    $veiculo->setIdempresa($obj['idempresa']);
                    $veiculo->setAno($obj['ano']);
                    $veiculo->setAntt($obj['antt']);
                    $veiculo->setCarroceria($obj['carroceria']);
                    $veiculo->setImagem($obj['imagem']);
                    $veiculo->setMarca($obj['marca']);
                    $veiculo->setModelo($obj['modelo']);
                    $veiculo->setPlaca($obj['placa']);
                    $veiculo->setRastreador($obj['rastreador']);
                    $veiculo->setTipo($obj['tipo']);
                    $veiculo->setStatus($obj['status']);
                    $veiculo->setCidadeDisponivel($obj['cidade_disponivel']);
                    $veiculos[$i]=$veiculo;
                    $i++;
                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $veiculos;

    }

}




?>