<?php
/**
* @file : Setting.class.php
*
*/
class Setting {

    private $id;
    private $label;
    private $description;
    private $name;
    private $value;
    private $type;
    private $other;

    private $link;

    public function __construct($link) {
        $this->link = $link;
    }

    public function getId() {
        return $this->id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getName() {
        return $this->name;
    }

    public function getValue() {
        return $this->value;
    }

    public function getType() {
        return $this->type;
    }

    public function getOther() {
        return $this->other;
    }

    public function setLabel( $label ) {
        $this->label = $label;
    }

    public function setDescription( $description ) {
        $this->description = $description;
    }

    public function setName( $name ) {
        $this->name = $name;
    }

    public function setValue( $value ) {
        $this->value = $value;
    }

    public function setType( $type ) {
        $this->type = $type;
    }

    public function setOther( $other ) {
        $this->other = $other;
    }
}

?>