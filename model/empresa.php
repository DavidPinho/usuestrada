<?php

Class Empresa{

	private $idempresa;
    private $cpf;
    private $cnpj;
    private $nome_fantasia;
    private $razao_social;
    private $nome_completo;
    private $estado;
    private $cidade;
    private $endereco;
    private $complemento;
    private $bairro;
    private $cep;
    private $email;
    private $telefone;
    private $celular;
    private $nome_usuario;
    private $senha;
    private $logo;
    private $tipo_empresa;

    /**
     * @param mixed $tipo_empresa
     */
    public function setTipoEmpresa($tipo_empresa)
    {
        $this->tipo_empresa = $tipo_empresa;
    }

    /**
     * @return mixed
     */
    public function getTipoEmpresa()
    {
        return $this->tipo_empresa;
    }




    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }



    public function setIdempresa($idempresa)
    {
        $this->idempresa = $idempresa;
    }

    public function getIdempresa()
    {
        return $this->idempresa;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setNomeCompleto($nome_completo)
    {
        $this->nome_completo = $nome_completo;
    }

    public function getNomeCompleto()
    {
        return $this->nome_completo;
    }

    public function setNomeFantasia($nome_fantasia)
    {
        $this->nome_fantasia = $nome_fantasia;
    }

    public function getNomeFantasia()
    {
        return $this->nome_fantasia;
    }

    public function setNomeUsuario($nome_usuario)
    {
        $this->nome_usuario = $nome_usuario;
    }

    public function getNomeUsuario()
    {
        return $this->nome_usuario;
    }


    public function setRazaoSocial($razao_social)
    {
        $this->razao_social = $razao_social;
    }

    public function getRazaoSocial()
    {
        return $this->razao_social;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }


    public function getJSONFormat(){

        $json=array("idempresa"=>$this->getIdempresa(),"cpf"=>$this->getCpf(), "cnpj"=>$this->getCnpj(), "nome_fantasia"=>$this->getNomeFantasia(),
            "razao_social"=>$this->getRazaoSocial(), "nome_completo"=>$this->getNomeCompleto(), "estado"=>$this->getEstado(), "cidade"=>$this->getCidade(),
            "endereco"=>$this->getEndereco(), "complemento"=>$this->getComplemento(), "bairro"=>$this->getBairro(), "cep"=>$this->getCep(),
            "email"=>$this->getEmail(), "telefone"=>$this->getTelefone(), "celular"=>$this->getCelular(), "nome_usuario"=>$this->getNomeUsuario(),
            "logo"=>$this->getLogo());
        return json_encode($json);
    }




}



?>