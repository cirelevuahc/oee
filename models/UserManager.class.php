<?php
/**
* @file : UserManager.class.php
*
*/
class UserManager {
    private $link;

    public function __construct( $link ) {
        $this->link = $link;
    }

    public function findAll() {
        $list    = [];
        $request = "SELECT * FROM user";
        $res     = mysqli_query( $this->link, $request );
        while ( $user = mysqli_fetch_object( $res, 'User', [$this->link] ) )
            $list[] = $user;
        return $list;
    }

    public function findByIdRole( $id_role ) {
        $id_role = intval( $id_role );
        $list    = [];
        $request = "SELECT * FROM user WHERE id_role = " . $id_role;
        $res     = mysqli_query( $this->link, $request );
        while ( $user = mysqli_fetch_object( $res, 'User', [$this->link] ) )
            $list[] = $user;
        return $list;
    }

    public function findById( $id ) {
        $id      = intval( $id );
        $request = "SELECT * FROM user WHERE id = " . $id;
        $res     = mysqli_query( $this->link, $request );
        $user    = mysqli_fetch_object( $res, 'User', [$this->link]);
        return $user;
    }

    public function findByRegisterConfirm( $register_confirm ) {
        $register_confirm = mysqli_real_escape_string( $this->link, $register_confirm );
        $request = "SELECT * FROM user WHERE register_confirm = '" . $register_confirm . "'";

        $res = mysqli_query( $this->link, $request );
        $user = mysqli_fetch_object( $res, 'User', [$this->link]);
        return $user;
    }

    public function create( $data ) {

        $user = new User( $this->link );

        if ( !isset( $data['id_role'] ) || $data['id_role'] == '' ) throw new Exception ('Role manquant');
        if ( !isset( $data['name'] ) || $data['name'] == '' ) throw new Exception ('Nom manquant');
        if ( !isset( $data['forname'] ) || $data['forname'] == '' ) throw new Exception ('Prénom manquant');
        if ( !isset( $data['email'] ) || $data['email'] == '' ) throw new Exception ('Email manquant');
        if ( !isset( $data['login'] ) || $data['login'] == '' ) throw new Exception ('Login manquant');
        if ( !isset( $data['password'] ) || $data['password'] == '' ) throw new Exception ('Mot de passe manquant');
        if ( !isset( $data['confirme_password'] ) || $data['confirme_password'] == '' ) throw new Exception ('Confirme mot de passe manquant');
        if ( !isset( $data['pseudo'] ) || $data['pseudo'] == '' ) throw new Exception ('Pseudo manquant');
        if ( !isset( $data['status'] ) || $data['status'] == '' ) throw new Exception ('Status manquant');

        if ( $data['password'] != $data['confirme_password'] ) throw new Exception ('Confirme mot de passe incorrect');

        $request    = "SELECT COUNT(*) AS count FROM user WHERE login = '" . $data['login'] . "'";
        $res        = mysqli_query( $this->link, $request );
        $user_count = mysqli_fetch_array( $res );
        if ( $user_count['count'] > 0 ) throw new Exception ('Ce login existe déjà !');

        $user->setIdRole( $data['id_role'] );
        $user->setName( $data['name'] );
        $user->setForname( $data['forname'] );
        $user->setEmail( $data['email'] );
        $user->setLogin( $data['login'] );
        $user->setPassword( password_hash( $data['password'], PASSWORD_BCRYPT, array( 'cost' => 8 ) ) );
        $user->setPseudo( $data['pseudo'] );
        $user->setStatus( $data['status'] );
        $user->setRegisterConfirm( md5( $data['email'] ) );

        $id_role          = mysqli_real_escape_string( $this->link, $user->getIdRole() );
        $name             = mysqli_real_escape_string( $this->link, $user->getName() );
        $forname          = mysqli_real_escape_string( $this->link, $user->getForname() );
        $email            = mysqli_real_escape_string( $this->link, $user->getEmail() );
        $login            = mysqli_real_escape_string( $this->link, $user->getLogin() );
        $password         = $user->getPassword();
        $pseudo           = mysqli_real_escape_string( $this->link, $user->getPseudo() );
        $status           = mysqli_real_escape_string( $this->link, $user->getStatus() );
        $register_confirm = $user->getRegisterConfirm();

        $csv = "','";
        $request = "INSERT INTO user ( id_role, name, forname, email, login, password, pseudo, status, register_confirm )
            VALUES('" . $id_role . $csv . $name . $csv . $forname . $csv . $email . $csv . $login . $csv . $password  . $csv . $pseudo . $csv . $status. $csv . $register_confirm . "')";

        $res = mysqli_query( $this->link, $request );

        if ( $res ) {
            $id = mysqli_insert_id( $this->link );

            if ( $id ) {
                $user = $this->findById( $id );

                return $user;
            }
            else
                throw new Exception ('Internal server error0');
        } else
            throw new Exception ('Internal server error1');


    }

    public function update( User $user ) {

        $id = $user->getId();

        if ( $id ) {
            $id_role          = mysqli_real_escape_string( $this->link, $user->getIdRole() );
            $name             = mysqli_real_escape_string( $this->link, $user->getName() );
            $forname          = mysqli_real_escape_string( $this->link, $user->getForname() );
            $email            = mysqli_real_escape_string( $this->link, $user->getEmail() );
            $login            = mysqli_real_escape_string( $this->link, $user->getLogin() );
            $password         = $user->getPassword();
            $pseudo           = mysqli_real_escape_string( $this->link, $user->getPseudo() );
            $status           = mysqli_real_escape_string( $this->link, $user->getStatus() );
            $register_confirm = mysqli_real_escape_string( $this->link, $user->getRegisterConfirm() );

            $request = "UPDATE user SET id_role='" . $id_role . "', name='" . $name . "', forname='" . $forname . "', email='" . $email . "', login='" . $login . "', password='" . $password . "', pseudo='" . $pseudo . "', status='" . $status . "', register_confirm='" . $register_confirm . "' WHERE id=" . $id;

            $res = mysqli_query( $this->link, $request );
            if ( $res )
                return $this->findById( $id );
            else
                throw new Exception ("Internal server error");
        }
    }

    public function remove( User $user ) {
        $id = $user->getId();

        if ( $id ) {

            $request = "DELETE FROM user WHERE id=" . $id;
            $res = mysqli_query( $this->link, $request );
            if ( $res )
                return $user;
            else
                throw new Exception ('Internal server error');
        }
    }

    public function login( $data ) {
        $user = new User( $this->link );


        if ( !isset( $data['password'] ) ) throw new Exception ('Mot de passe manquant');
        if ( !isset( $data['login'] ) ) throw new Exception ('Login manquant');

        $password = $data['password'];
        $login    = $data['login'];

        $request = "SELECT * FROM user WHERE login='" . $login . "' LIMIT 1";

        $res = mysqli_query( $this->link, $request );

        $line = mysqli_fetch_assoc( $res );

        if ( password_verify( $password, $line['password']) ) {
            $_SESSION['user']['id']      = $line['id'];
            $_SESSION['user']['role']    = $line['id_role'];
            $_SESSION['user']['pseudo']  = $line['pseudo'];
            $_SESSION['user']['name']    = $line['name'];
            $_SESSION['user']['forname'] = $line['forname'];
            $_SESSION['user']['status']  = $line['status'];

            $role_manager = new RoleManager( $this->link );
            $role = $role_manager->findById( $_SESSION['user']['role'] );

            $_SESSION['user']['capability']['access_admin'] = $role->getCapabilityAccessAdmin();
            $_SESSION['user']['capability']['admin']        = $role->getCapabilityAdmin();
            $_SESSION['user']['capability']['editor']       = $role->getCapabilityEditor();
            $_SESSION['user']['capability']['autor']        = $role->getCapabilityAuthor();
            $_SESSION['user']['capability']['member']       = $role->getCapabilityMember();

        }
    }


}
?>
