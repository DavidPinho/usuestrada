<?php


Class Transacao{


    private $idtransacao;
    private $idembarcador;
    private $idtransportador;
    private $idfrete;
    private $idveiculo;
    private $preco;
    private $chat;
    private $status;

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
     * @param mixed $chat
     */
    public function setChat($chat)
    {
        $this->chat = $chat;
    }

    /**
     * @return mixed
     */
    public function getChat()
    {
        return $this->chat;
    }

    /**
     * @param mixed $idembarcador
     */
    public function setIdembarcador($idembarcador)
    {
        $this->idembarcador = $idembarcador;
    }

    /**
     * @return mixed
     */
    public function getIdembarcador()
    {
        return $this->idembarcador;
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
     * @param mixed $idtransportador
     */
    public function setIdtransportador($idtransportador)
    {
        $this->idtransportador = $idtransportador;
    }

    /**
     * @return mixed
     */
    public function getIdtransportador()
    {
        return $this->idtransportador;
    }

    /**
     * @param mixed $idtrasacao
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
     * @param mixed $price
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;
    }

    /**
     * @return mixed
     */
    public function getPreco()
    {
        return $this->preco;
    }





}


?>