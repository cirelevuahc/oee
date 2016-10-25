<?php
/**
* @file : User.class.php
*
*/
class User {

    private $id;
    private $id_role;
    private $name;
    private $forname;
    private $email;
    private $login;
    private $password;
    private $pseudo;
    private $date;
    private $status;
    private $register_confirm;

    private $link;
    private $role;

    public function __construct( $link ) {
        $this->link = $link;
    }

    public function getRole() {
        if ( $this->role === null ) {
            $manager = new RoleManager( $this->link );

            $this->role = $manager->findById( $this->id_role );
        }

        return $this->role;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdRole() {
        return $this->id_role;
    }

    public function getName() {
        return $this->name;
    }

    public function getForname() {
        return $this->forname;
    }
    public function getEmail() {
        return $this->email;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function getDate() {
        return $this->date;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getRegisterConfirm() {
        return $this->register_confirm;
    }

    public function setIdRole( $role ) {
        $role = intval( $role );

        $this->id_role = $role;
    }

    public function setName( $name ) {
        if ( strlen( $name ) < 3 )
            throw new Exception ('Nom trop court (< 3)');
        else if ( strlen( $name ) > 63 )
            throw new Exception ('Nom trop long (> 63)');

        $this->name = $name;
    }

    public function setForname( $forname ) {
        if ( strlen( $forname ) < 3 )
            throw new Exception ('Prénom trop court (< 3)');
        else if ( strlen( $forname ) > 63 )
            throw new Exception ('Prénom trop long (> 63)');

        $this->forname = $forname;
    }

    public function setEmail( $email ) {
        if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) == false )
            throw new Exception ('Email invalide');

        $this->email = $email;
    }

    public function setLogin( $login ) {
        if ( strlen( $login ) < 3 )
            throw new Exception ('Login trop court (< 3)');
        else if ( strlen( $login ) > 63 )
            throw new Exception ('Login trop long (> 63)');

        $this->login = $login;
    }

    public function setPassword( $password ) {
        if ( strlen( $password ) < 3 )
            throw new Exception ('Mot de passe trop court (< 3)');
        else if ( strlen( $password ) > 63 )
            throw new Exception ('Mot de passe trop long (> 63)');

        $this->password = $password;
    }

    public function setPseudo( $pseudo ) {
        if ( strlen( $pseudo ) < 3 )
            throw new Exception ('Pseudo trop court (< 3)');
        else if ( strlen( $pseudo ) > 63 )
            throw new Exception ('Pseudo trop long (> 63)');

        $this->pseudo = $pseudo;
    }

    public function setRegisterConfirm( $register_confirm ) {
        $this->register_confirm = $register_confirm;
    }

    public function setRole( $role ) {
        $role = intval( $role );

        $this->role = $role;
    }

    public function setStatus( $status ) {
        $status = intval( $status );;

        $this->status = $status;
    }




}

?>