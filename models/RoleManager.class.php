<?php
/**
* @file : RoleManager.class.php
*
*/
class RoleManager {
    private $link;

    public function __construct( $link ) {
        $this->link = $link;
    }

    public function findAll() {
        $list = [];
        $request = "SELECT * FROM role";
        $res = mysqli_query( $this->link, $request );
        while ( $role = mysqli_fetch_object( $res, 'Role' , [$this->link] ) )
            $list[] = $role;
        return $list;
    }



    public function findById( $id ) {
        $id = intval( $id );
        $request = "SELECT * FROM role WHERE id = " . $id;
        $res = mysqli_query( $this->link, $request );
        $role = mysqli_fetch_object( $res, 'Role' , [$this->link]);
        return $role;
    }

    public function findByName( $name ) {
        $name = mysqli_real_escape_string( $this->link, $name );
        $request = "SELECT * FROM role WHERE name = '" . $name . "'";
        $res = mysqli_query( $this->link, $request );
        $role = mysqli_fetch_object( $res, 'Role', array( $this->link ) );
        return $role;
    }

    public function create( $data ) {

        $role = new Role( $this->link );

        if ( !isset( $data['name'] ) || $data['name'] == '' ) throw new Exception ('Nom manquant');
        if ( !isset( $data['label'] ) || $data['label'] == '' ) throw new Exception ('Label manquant');
        if ( !isset( $data['description'] ) || $data['description'] == '' ) throw new Exception ('Prénom manquant');
        if ( !isset( $data['capability_access_admin'] ) || $data['capability_access_admin'] == '' ) throw new Exception ('Capacité voir admin manquant');
        if ( !isset( $data['capability_admin'] ) || $data['capability_admin'] == '' ) throw new Exception ('Capacité admin manquant');
        if ( !isset( $data['capability_editor'] ) || $data['capability_editor'] == '' ) throw new Exception ('Capacité editeur manquant');
        if ( !isset( $data['capability_author'] ) || $data['capability_author'] == '' ) throw new Exception ('Capacité auteur manquant');
        if ( !isset( $data['capability_member'] ) || $data['capability_member'] == '' ) throw new Exception ('Capacité membre manquant');

        $role->setName( $data['name'] );
        $role->setLabel( $data['label'] );
        $role->setDescription( $data['description'] );
        $role->setCapabilityAccessAdmin( $data['capability_access_admin'] );
        $role->setCapabilityAdmin( $data['capability_admin'] );
        $role->setCapabilityEditor( $data['capability_editor'] );
        $role->setCapabilityAuthor( $data['capability_author'] );
        $role->setCapabilityMember( $data['capability_member'] );

        $name                    = mysqli_real_escape_string( $this->link, $role->getName() );
        $label                   = mysqli_real_escape_string( $this->link, $role->getLabel() );
        $description             = mysqli_real_escape_string( $this->link, $role->getDescription() );
        $capability_access_admin = mysqli_real_escape_string( $this->link, $role->getCapabilityAccessAdmin() );
        $capability_admin        = mysqli_real_escape_string( $this->link, $role->getCapabilityAdmin() );
        $capability_editor       = mysqli_real_escape_string( $this->link, $role->getCapabilityEditor() );
        $capability_author       = mysqli_real_escape_string( $this->link, $role->getCapabilityAuthor() );
        $capability_member       = mysqli_real_escape_string( $this->link, $role->getCapabilityMember() );


        $csv = "','";
        $request = "INSERT INTO role ( name, label, description, capability_access_admin, capability_admin, capability_editor, capability_author, capability_member )
            VALUES('" . $name . $csv . $label . $csv . $description . $csv . $capability_access_admin . $csv . $capability_admin . $csv . $capability_editor  . $csv . $capability_author . $csv .  $capability_member . "')";

        $res = mysqli_query( $this->link, $request );

        if ( $res ) {
            $id = mysqli_insert_id( $this->link );

            if ( $id ) {
                $role = $this->findById( $id );

                return $role;
            }
            else
                throw new Exception ('Internal server error0');
        } else
            throw new Exception ('Internal server error1');


    }

    public function update( User $role ) {

        $id = $role->getId();

        if ( $id ) {
            $name                    = mysqli_real_escape_string( $this->link, $role->getName() );
            $label                   = mysqli_real_escape_string( $this->link, $role->getLabel() );
            $description             = mysqli_real_escape_string( $this->link, $role->getDescription() );
            $capability_access_admin = mysqli_real_escape_string( $this->link, $role->getCapabilityAccessAdmin() );
            $capability_admin        = mysqli_real_escape_string( $this->link, $role->getCapabilityAdmin() );
            $capability_editor       = mysqli_real_escape_string( $this->link, $role->getCapabilityEditor() );
            $capability_author       = mysqli_real_escape_string( $this->link, $role->getCapabilityAuthor() );
            $capability_member       = mysqli_real_escape_string( $this->link, $role->getCapabilityMember() );


            $request = "UPDATE role SET name='" . $name . "', label='" . $label . "', description='" . $description . "', capability_access_admin='" . $capability_access_admin . "', capability_admin='" . $capability_admin . "', capability_editor='" . $capability_editor . "', capability_author='" . $capability_author . "', capability_member='" . $capability_member . "' WHERE id=" . $id;

            $res = mysqli_query( $this->link, $request );
            if ( $res )
                return $this->findById( $id );
            else
                throw new Exception ("Internal server error");
        }
    }

    public function remove( User $role ) {
        $id = $role->getId();

        if ( $id ) {

            $request = "DELETE FROM role WHERE id=" . $id;
            $res = mysqli_query( $this->link, $request );
            if ( $res )
                return $role; // ou true
            else
                throw new Exception ('Internal server error');
        }
    }


}
?>
