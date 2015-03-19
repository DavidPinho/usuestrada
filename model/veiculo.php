<?php


Class Veiculo{

    private $idveiculo;
    private $idempresa;
    private $tipo;
    private $carroceria;
    private $rastreador;
    private $marca;
    private $modelo;
    private $ano;
    private $placa;
    private $imagem;
    private $antt;
    private $status;
    private $cidade_disponivel;

    /**
     * @param mixed $cidade_disponivel
     */
    public function setCidadeDisponivel($cidade_disponivel)
    {
        $this->cidade_disponivel = $cidade_disponivel;
    }

    /**
     * @return mixed
     */
    public function getCidadeDisponivel()
    {
        return $this->cidade_disponivel;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }



    /**
     * @param mixed $antt
     */
    public function setAntt($antt)
    {
        $this->antt = $antt;
    }

    /**
     * @return mixed
     */
    public function getAntt()
    {
        return $this->antt;
    }

    /**
     * @param mixed $ano
     */
    public function setAno($ano)
    {
        $this->ano = $ano;
    }

    /**
     * @return mixed
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * @param mixed $carroceria
     */
    public function setCarroceria($carroceria)
    {
        $this->carroceria = $carroceria;
    }

    /**
     * @return mixed
     */
    public function getCarroceria()
    {
        return $this->carroceria;
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
     * @param mixed $idveiculo
     */
    public function setIdveiculo($idveiculo)
    {
        $this->idveiculo = $idveiculo;
    }

    /**
     * @return mixed
     */
    public function getIdveiculo()
    {
        return $this->idveiculo;
    }

    /**
     * @param mixed $imagem
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }

    /**
     * @return mixed
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * @param mixed $marca
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    /**
     * @return mixed
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * @param mixed $modelo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * @return mixed
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * @param mixed $placa
     */
    public function setPlaca($placa)
    {
        $this->placa = $placa;
    }

    /**
     * @return mixed
     */
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * @param mixed $rastreador
     */
    public function setRastreador($rastreador)
    {
        $this->rastreador = $rastreador;
    }

    /**
     * @return mixed
     */
    public function getRastreador()
    {
        return $this->rastreador;
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


}

?>