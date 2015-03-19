<?php


Class Tracking{

    private $idtracking;
    private $idtransacao;
    private $dataTracking;
    private $status;

    /**
     * @param mixed $data
     */
    public function setDataTracking($data)
    {
        $this->dataTracking = $data;
    }

    /**
     * @return mixed
     */
    public function getDataTracking()
    {
        return $this->dataTracking;
    }

    /**
     * @param mixed $idtracking
     */
    public function setIdtracking($idtracking)
    {
        $this->idtracking = $idtracking;
    }

    /**
     * @return mixed
     */
    public function getIdtracking()
    {
        return $this->idtracking;
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






}


?>