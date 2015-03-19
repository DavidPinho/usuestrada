<?php


include_once 'baseModel.php';
include_once 'tracking.php';


Class TrackingDB extends BaseModel{


    public function __construct(){
        parent::__construct();
    }

    public function inserir(Tracking $tracking){

        try{
            if( $this->connection ){

                $stmt = $this->connection->prepare("INSERT INTO tracking (idtransacao, data_tracking, status) VALUES (:idtransacao, :data_tracking, :status)");

                $stmt->bindParam(':idtransacao', $tracking->getIdtransacao());
                $stmt->bindParam(':data_tracking', $tracking->getDataTracking());
                $stmt->bindParam(':status', $tracking->getStatus());


                $stmt->execute();

                $result=$this->connection->lastInsertId();

            }
        } catch(PDOException $e){
            echo $e->getMessage();
        }

        return $result;


    }

}





?>
