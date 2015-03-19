<?php

Class Estado{


    private $id;

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $uf
     */
    public function setUf($uf)
    {
        $this->uf = $uf;
    }

    /**
     * @return mixed
     */
    public function getUf()
    {
        return $this->uf;
    }
    private $uf;
    private $nome;

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    public function getJSONFormat(){

        $json=array("id"=>$this->getId(),"uf"=>$this->getUf(), "nome"=>$this->getNome());
        return json_encode($json);
    }




}


?>