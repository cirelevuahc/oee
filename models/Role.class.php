<?php
/**
* @file : Role.class.php
*
*/
class Role {

    private $id;
    private $name;
    private $label;
    private $description;
    private $capability_access_admin;
    private $capability_admin;
    private $capability_editor;
    private $capability_author;
    private $capability_member;


    private $link;

    public function __construct($link) {
        $this->link = $link;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getCapabilityAccessAdmin() {
        return $this->capability_access_admin;
    }

    public function getCapabilityAdmin() {
        return $this->capability_admin;
    }

    public function getCapabilityEditor() {
        return $this->capability_editor;
    }

    public function getCapabilityAuthor() {
        return $this->capability_author;
    }

    public function getCapabilityMember() {
        return $this->capability_member;
    }


    public function setName( $name ) {
        if ( strlen( $name ) < 3 )
            throw new Exception ("Label trop court (< 3)");
        else if ( strlen( $name ) > 63 )
            throw new Exception ("Label trop long (> 63)");

        $this->name = $name;
    }

    public function setLabel( $label ) {
        if ( strlen( $label ) < 3 )
            throw new Exception ("Label trop court (< 3)");
        else if ( strlen( $label ) > 63 )
            throw new Exception ("Label trop long (> 63)");

        $this->label = $label;
    }

    public function setDescription( $description ) {
        if ( strlen( $description ) < 3 )
            throw new Exception ("Déscription trop court (< 3)");
        else if ( strlen( $description ) > 511 )
            throw new Exception ("Déscription trop long (> 511)");

        $this->description = $description;
    }

    public function setCapabilityAccessAdmin( $capability_access_admin ) {
        $capability_access_admin = intval( $capability_access_admin );

        $this->capability_access_admin = $capability_access_admin;
    }

    public function setCapabilityAdmin( $capability_admin ) {
        $capability_admin = intval( $capability_admin );

        $this->capability_admin = $capability_admin;
    }

     public function setCapabilityEditor( $capability_editor ) {
        $capability_editor = intval( $capability_editor );

        $this->capability_editor = $capability_editor;
    }

    public function setCapabilityAuthor( $capability_author ) {
        $capability_author = intval( $capability_author );

        $this->capability_author = $capability_author;
    }



    public function setCapabilityMember( $capability_member ) {
        $capability_member = intval( $capability_member );

        $this->capability_member = $capability_member;
    }

}

?>