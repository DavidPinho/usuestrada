<?php

include_once 'baseModel.php';
include_once 'empresa.php';

class EmpresaDB extends BaseModel
{

	public function __construct(){
		parent::__construct();
	}

	public function insert(Empresa $empresa){

		try{
           if( $this->connection ){

               $stmt = $this->connection->prepare("INSERT INTO empresa (cpf, cnpj, nome_completo, razao_social, nome_fantasia, estado, cidade, endereco,complemento, bairro, cep, email, telefone, celular, nome_usuario, senha,logo,tipo_empresa) VALUES (:cpf, :cnpj, :nome_completo, :razao_social, :nome_fantasia, :estado, :cidade, :endereco,:complemento, :bairro, :cep, :email, :telefone, :celular, :nome_usuario, :senha,:logo, :tipo_empresa)");

               $stmt->bindParam(':cpf', $empresa->getCpf());
               $stmt->bindParam(':cnpj', $empresa->getCnpj());
               $stmt->bindParam(':nome_completo', $empresa->getNomeCompleto());
               $stmt->bindParam(':razao_social', $empresa->getRazaoSocial());
               $stmt->bindParam(':nome_fantasia', $empresa->getNomeFantasia());
               $stmt->bindParam(':estado', $empresa->getEstado());
               $stmt->bindParam(':cidade', $empresa->getCidade());
               $stmt->bindParam(':endereco', $empresa->getEndereco());
               $stmt->bindParam(':complemento', $empresa->getComplemento());
               $stmt->bindParam(':bairro', $empresa->getBairro());
               $stmt->bindParam(':cep', $empresa->getCep());
               $stmt->bindParam(':email', $empresa->getEmail());
               $stmt->bindParam(':telefone', $empresa->getTelefone());
               $stmt->bindParam(':celular', $empresa->getCelular());
               $stmt->bindParam(':nome_usuario', $empresa->getNomeUsuario());
               $stmt->bindParam(':senha', $empresa->getSenha());
               $stmt->bindParam(':logo', $empresa->getLogo());
               $stmt->bindParam(':tipo_empresa', $empresa->getTipoEmpresa());

			   $stmt->execute();

               $result =$this->connection->lastInsertId();
               
           }
        } catch(PDOException $e){
            echo $e->getMessage();
        } 

        return $result;
	}


    public function checaEmail($email){

        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM empresa WHERE email = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($objs==null)
                    return true;
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return false;
    }

    public function autenticaLogin($email, $senha){

        $empresa= new Empresa();

        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM empresa WHERE (email = :email or nome_usuario = :nome_usuario) and senha = :senha");
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':nome_usuario', $email);
                $stmt->bindParam(':senha', $senha);

                $stmt->execute();


                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($objs as $obj){
                    $empresa->setIdempresa($obj['idempresa']);
                    $empresa->setEstado($obj['estado']);
                    $empresa->setNomeUsuario($obj['nome_usuario']);
                    $empresa->setBairro($obj['bairro']);
                    $empresa->setCelular($obj['celular']);
                    $empresa->setTelefone($obj['telefone']);
                    $empresa->setCpf($obj['cpf']);
                    $empresa->setCnpj($obj['cnpj']);
                    $empresa->setNomeFantasia($obj['nome_fantasia']);
                    $empresa->setRazaoSocial($obj['razao_social']);
                    $empresa->setNomeCompleto($obj['nome_completo']);
                    $empresa->setCidade($obj['cidade']);
                    $empresa->setEndereco($obj['endereco']);
                    $empresa->setComplemento($obj['complemento']);
                    $empresa->setCep($obj['cep']);
                    $empresa->setEmail($obj['email']);
                    $empresa->setSenha($obj['senha']);
                    $empresa->setLogo($obj['logo']);
                    $empresa->setTipoEmpresa($obj['tipo_empresa']);
                }

                return $empresa;
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $empresa;
    }


    public function buscaTransportadoras($cidade, $estado,$nome_empresa,$tipo_veiculo,$offset, $itemsPorPag){

        $transportadoras = array();

        $i=0;
        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT empresa.idempresa, empresa.cidade, empresa.estado, empresa.nome_completo,empresa.razao_social, empresa.logo FROM empresa inner join veiculo on empresa.idempresa = veiculo.idempresa
                where empresa.cidade in (select id from cad_cidades where nome like '%".$cidade."%') and
                empresa.estado in (select estado from cad_cidades where uf like '%".$estado."%') and
                (empresa.nome_completo like '%".$nome_empresa."%' or empresa.razao_social like '%".$nome_empresa."%' or empresa.nome_fantasia like '%".$nome_empresa."%') and
                veiculo.tipo like '%".$tipo_veiculo."%' limit ".$offset.",".$itemsPorPag);

                $stmt->execute();

                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($objs as $obj){
                    $empresa =new Empresa();
                    $empresa->setIdempresa($obj['idempresa']);
                    $empresa->setEstado($obj['estado']);
                    $empresa->setRazaoSocial($obj['razao_social']);
                    $empresa->setNomeCompleto($obj['nome_completo']);
                    $empresa->setCidade($obj['cidade']);
                    $empresa->setLogo($obj['logo']);
                    $transportadoras[$i] = $empresa;

                    $i++;
                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $transportadoras;

    }



    public function contaTransportadoras($cidade, $estado,$nome_empresa,$tipo_veiculo){

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

    public function selecionaEmpresaById($id){

        $empresa= new Empresa();

        try{

            if($this->connection){
                $stmt = $this->connection->prepare("SELECT * FROM empresa WHERE idempresa = :id");
                $stmt->bindParam(':id', $id);

                $stmt->execute();


                $objs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($objs as $obj){
                    $empresa->setIdempresa($obj['idempresa']);
                    $empresa->setEstado($obj['estado']);
                    $empresa->setNomeUsuario($obj['nome_usuario']);
                    $empresa->setBairro($obj['bairro']);
                    $empresa->setCelular($obj['celular']);
                    $empresa->setTelefone($obj['telefone']);
                    $empresa->setCpf($obj['cpf']);
                    $empresa->setCnpj($obj['cnpj']);
                    $empresa->setNomeFantasia($obj['nome_fantasia']);
                    $empresa->setRazaoSocial($obj['razao_social']);
                    $empresa->setNomeCompleto($obj['nome_completo']);
                    $empresa->setCidade($obj['cidade']);
                    $empresa->setEndereco($obj['endereco']);
                    $empresa->setComplemento($obj['complemento']);
                    $empresa->setCep($obj['cep']);
                    $empresa->setEmail($obj['email']);
                    $empresa->setSenha($obj['senha']);
                    $empresa->setLogo($obj['logo']);
                    $empresa->setTipoEmpresa($obj['tipo_empresa']);
                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        return $empresa;
    }



}


?>