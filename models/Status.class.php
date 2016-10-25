<?php
/**
* @file : Status.class.php
*
*/
class Status {

    private $status;
    private $label;

    public function getStatus() {
        return $this->status;
    }

    public function getLabel() {
        return $this->label;
    }


    public function setStatus( $status ) {
        $this->status = $status;
    }

    public function setLabel( $label ) {
        $this->label = $label;
    }
}

?>