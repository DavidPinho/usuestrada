<?php


Class Mensagem{


    private $idmensagem;
    private $idtransacao;
    private $idempresa;
    private $texto;
    private $data_hora;



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
     * @param mixed $data_hora
     */
    public function setDataHora($data_hora)
    {
        $this->data_hora = $data_hora;
    }

    /**
     * @return mixed
     */
    public function getDataHora()
    {
        return $this->data_hora;
    }


    /**
     * @param mixed $idmensagem
     */
    public function setIdmensagem($idmensagem)
    {
        $this->idmensagem = $idmensagem;
    }

    /**
     * @return mixed
     */
    public function getIdmensagem()
    {
        return $this->idmensagem;
    }

    /**
     * @param mixed $idtransacao
     */
    public function setIdtransacao($idtransacao)
    {
        $this->idtransacao = $idtransacao;
    }

    /**
     * @return mixed
     */
    public function getIdtransacao()
    {
        return $this->idtransacao;
    }



    /**
     * @param mixed $texto
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    /**
     * @return mixed
     */
    public function getTexto()
    {
        return $this->texto;
    }



}


?>