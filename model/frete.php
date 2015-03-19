<?php


Class Frete{

    private $idfrete;
    private $idempresa;
    private $tipo;
    private $detalhes;
    private $estado_origem;
    private $cidade_origem;
    private $estado_destino;
    private $cidade_destino;

    /**
     * @param mixed $cidade_destino
     */
    public function setCidadeDestino($cidade_destino)
    {
        $this->cidade_destino = $cidade_destino;
    }

    /**
     * @return mixed
     */
    public function getCidadeDestino()
    {
        return $this->cidade_destino;
    }

    /**
     * @param mixed $cidade_origem
     */
    public function setCidadeOrigem($cidade_origem)
    {
        $this->cidade_origem = $cidade_origem;
    }

    /**
     * @return mixed
     */
    public function getCidadeOrigem()
    {
        return $this->cidade_origem;
    }

    /**
     * @param mixed $detalhes
     */
    public function setDetalhes($detalhes)
    {
        $this->detalhes = $detalhes;
    }

    /**
     * @return mixed
     */
    public function getDetalhes()
    {
        return $this->detalhes;
    }

    /**
     * @param mixed $estado_destino
     */
    public function setEstadoDestino($estado_destino)
    {
        $this->estado_destino = $estado_destino;
    }

    /**
     * @return mixed
     */
    public function getEstadoDestino()
    {
        return $this->estado_destino;
    }

    /**
     * @param mixed $estado_origem
     */
    public function setEstadoOrigem($estado_origem)
    {
        $this->estado_origem = $estado_origem;
    }

    /**
     * @return mixed
     */
    public function getEstadoOrigem()
    {
        return $this->estado_origem;
    }

    /**
     * @param mixed $idempresa
     */
    public function setIdempresa($idempresa)
    {
        $this->idempresa = $idempresa;
    }

    /**
     * @return mixed
     */
    public function getIdempresa()
    {
        return $this->idempresa;
    }

    /**
     * @param mixed $idfrete
     */
    public function setIdfrete($idfrete)
    {
        $this->idfrete = $idfrete;
    }

    /**
     * @return mixed
     */
    public function getIdfrete()
    {
        return $this->idfrete;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }



    public function getJSONFormat(){

        $json=array("idfrete"=>$this->getIdfrete(),"idempresa"=>$this->getIdempresa(),"tipo"=>$this->getTipo(), "detalhes"=>$this->getDetalhes(),"estado_origem"=>$this->getEstadoOrigem(),
        "cidade_origem"=>$this->getCidadeOrigem(), "estado_destino"=>$this->getEstadoDestino(), "cidade_destino"=>$this->getCidadeDestino());
        return json_encode($json);
    }


}


?>