<?php
/**
* @file : SettingManager.class.php
*
*/
class SettingManager {

    private $link;

    public function __construct( $link ) {
        $this->link = $link;
    }

    public function findAll() {
        $list = [];
        $request = "SELECT * FROM setting";
        $res = mysqli_query( $this->link, $request );
        while ( $setting = mysqli_fetch_object( $res, 'Setting', array( $this->link ) ) )
            $list[] = $setting;
        return $list;
    }

    public function findById( $id ) {
        $id = intval( $id );
        $request = "SELECT * FROM setting WHERE id = " . $id;
        $res = mysqli_query( $this->link, $request );
        $setting = mysqli_fetch_object( $res, 'Setting', array( $this->link ) );
        return $setting;
    }

    public function findByName( $name ) {
        $name = mysqli_real_escape_string( $this->link, $name );
        $request = "SELECT * FROM setting WHERE name = '" . $name . "'";
        $res = mysqli_query( $this->link, $request );
        $setting = mysqli_fetch_object( $res, 'Setting', array( $this->link ) );
        return $setting;
    }

    public function findFirst() {
        $request = "SELECT * FROM setting LIMIT 1";
        $res = mysqli_query( $this->link, $request );
        $setting = mysqli_fetch_object( $res, 'Setting', array( $this->link ) );
        return $setting;
    }

    public function create( $data ) {

        $setting = new Setting( $this->link );

        if ( !isset( $data['label'] ) ) throw new Exception ('Label manquant');
        if ( !isset( $data['description'] ) ) throw new Exception ('Déscription manquante');
        if ( !isset( $data['name'] ) ) throw new Exception ('Nom manquant');
        if ( !isset( $data['value'] ) ) throw new Exception ('Valeur manquante' );
        if ( !isset( $data['type'] ) ) throw new Exception ('Type manquante' );


        $setting->setLabel( $data['label'] );
        $setting->setDescription( $data['description'] );
        $setting->setName( $data['name'] );
        $setting->setValue( $data['value'] );
        $setting->setType( $data['type'] );
        $setting->setOther( $data['other'] );

        $label          = mysqli_real_escape_string( $this->link, $setting->getLabel() );
        $description    = mysqli_real_escape_string( $this->link, $setting->getdescription() );
        $name           = mysqli_real_escape_string( $this->link, $setting->getName() );
        $value          = mysqli_real_escape_string( $this->link, $setting->getValue() );
        $type           = mysqli_real_escape_string( $this->link, $setting->getType() );
        $other          = mysqli_real_escape_string( $this->link, $setting->getOther() );

        $csv = "','";
        $request = "INSERT INTO setting ( label, description, name, value, type, other )
            VALUES('" . $label . $csv . $description . $csv . $name . $csv . $value . $csv . $type . $csv . $other . "')";

        $res = mysqli_query( $this->link, $request );

        if ( $res ) {
            $id = mysqli_insert_id( $this->link );

            if ( $id ) {
                $setting = $this->findById( $id );
                return $setting;
            }
            else
                throw new Exception ("Internal server error");
        }
        else
            throw new Exception ("Internal server error");

    }


    public function update( Setting $setting ) {

        $id = $setting->getId();

        if ( $id ) {

            $value = mysqli_real_escape_string( $this->link, $setting->getValue() );

            $request = "UPDATE setting SET value='" . $value  . "' WHERE id=" . $id;

            $res = mysqli_query( $this->link, $request );
            if ( $res )
                return $this->findById( $id );
            else
                throw new Exception ("Internal server error");
        }
    }

    public function remove( Setting $setting ) {
        $id = $setting->getId();

        if ( $id ) {

            $request = "DELETE FROM setting WHERE id=" . $id;
            $res = mysqli_query( $this->link, $request );
            if ( $res )
                return $setting; // ou true
            else
                throw new Exception ("Internal server error");
        }
    }

}
?>
