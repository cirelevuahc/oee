<?php
/**
* @file : StatusManager.class.php
*
*/
class StatusManager {

    private $status = array();

    public function __construct() {

        $status = new Status();
        $status->setStatus(0);
        $status->setLabel('En attente');
        $this->status[] = $status;

        $status = new Status();
        $status->setStatus(1);
        $status->setLabel('Actif');
        $this->status[] = $status;

        $status = new Status();
        $status->setStatus(2);
        $status->setLabel('Inactif');
        $this->status[] = $status;

    }

    public function findAll() {
        return $this->status;
    }

    public function findByStatus( $current_status ) {
        $i      = 0;
        $count  = count( $this->status );
        while( $i < $count ) {

            $status = $this->status[$i];

            if ( $status->getStatus() == $current_status ) return $status;

            $i++;
        }

    }


}

?>