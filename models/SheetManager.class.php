<?php
/**
* @file : SheetManager.class.php
*
*/
class SheetManager {

    private $link;

    public function __construct( $link ) {
        $this->link = $link;
    }

    public function findAll( $order_by = 'id' ) {

        $list = [];
        $request = "SELECT * FROM sheet ORDER BY " . $order_by;
        $res = mysqli_query( $this->link, $request );
        while ( $sheet = mysqli_fetch_object( $res, 'Sheet', array( $this->link ) ) )
            $list[] = $sheet;
        return $list;
    }

    public function findAllByIdUser( $id_user ) {
        $id_user = intval( $id_user );
        $list = [];
        $request = "SELECT * FROM sheet WHERE id_user = " . $id_user;
        $res = mysqli_query( $this->link, $request );
        while ( $sheet = mysqli_fetch_object( $res, 'Sheet', array( $this->link ) ) )
            $list[] = $sheet;
        return $list;
    }

    public function findById( $id ) {
        $id = intval( $id );
        $request = "SELECT * FROM sheet WHERE id = " . $id;
        $res = mysqli_query( $this->link, $request );
        $sheet = mysqli_fetch_object( $res, 'Sheet', array( $this->link ) );
        return $sheet;
    }

    public function findFirst() {
        $request = "SELECT * FROM sheet LIMIT 1";
        $res = mysqli_query( $this->link, $request );
        $sheet = mysqli_fetch_object( $res, 'Sheet', array( $this->link ) );
        return $sheet;
    }

    public function findByUser( User $user ) {
        $list = [];
        $id = $user->getId();
        $request = "SELECT * FROM sheet WHERE id_user = " . $id;
        $res = mysqli_query( $this->link, $request );
        while ( $sheet = mysqli_fetch_object( $res, 'Sheet', array( $this->link ) ) )
            $list[] = $sheet;
        return $list;
    }


    public function create( $data, User $user ) {

        $sheet = new Sheet( $this->link );

        if ( !isset( $data['title'] ) ) throw new Exception ('Titre manquant');
        if ( !isset( $data['content'] ) ) throw new Exception ('Contenu manquant');
        if ( !isset( $data['image'] ) ) throw new Exception ('Image manquante');
        if ( !isset( $data['video'] ) ) throw new Exception ('Vidéo manquante' );

        $sheet->setTitle( $data['title'] );
        $sheet->setContent( $data['content'] );
        $sheet->setImage( $data['image'] );
        $sheet->setVideo( $data['video'] );
        $sheet->setNewsletter( $data['newsletter'] );
        $sheet->setReport( $data['report'] );

        $id_user    = $user->getId();
        $title      = mysqli_real_escape_string( $this->link, $sheet->getTitle() );
        $content    = mysqli_real_escape_string( $this->link, $sheet->getContent() );
        $image      = mysqli_real_escape_string( $this->link, $sheet->getImage() );
        $video      = mysqli_real_escape_string( $this->link, $sheet->getVideo() );
        $newsletter = mysqli_real_escape_string( $this->link, $sheet->getNewsletter() );
        $report     = mysqli_real_escape_string( $this->link, $sheet->getReport() );

        $csv = "','";
        $request = "INSERT INTO sheet (id_user, title, content, image, video, newsletter, report )
            VALUES('" . $id_user . $csv . $title . $csv . $content . $csv . $image . $csv . $video . $csv . $newsletter . $csv . $report . "')";

        $res = mysqli_query( $this->link, $request );

        if ( $res ) {
            $id = mysqli_insert_id( $this->link );

            if ( $id ) {
                $sheet = $this->findById( $id );
                return $sheet;
            }
            else
                throw new Exception ("Internal server error");
        }
        else
            throw new Exception ("Internal server error");

    }



    public function update( Sheet $sheet ) {

        $id = $sheet->getId();

        if ( $id ) {
            $id_user    = mysqli_real_escape_string( $this->link, $sheet->getIdUser() );
            $title      = mysqli_real_escape_string( $this->link, $sheet->getTitle() );
            $content    = mysqli_real_escape_string( $this->link, $sheet->getContent() );
            $image      = mysqli_real_escape_string( $this->link, $sheet->getImage() );
            $video      = mysqli_real_escape_string( $this->link, $sheet->getVideo() );
            $menu_order = mysqli_real_escape_string( $this->link, $sheet->getMenuOrder() );
            $newsletter = mysqli_real_escape_string( $this->link, $sheet->getNewsletter() );
            $report     = mysqli_real_escape_string( $this->link, $sheet->getReport() );

            $request = "UPDATE sheet SET id_user='" . $id_user . "', title='" . $title . "', content='" . $content . "', image='" . $image . "', video='" . $video . "', menu_order='" . $menu_order . "', newsletter='" . $newsletter . "',report='" . $report . "' WHERE id=" . $id;

            $res = mysqli_query( $this->link, $request );
            if ( $res )
                return $this->findById( $id );
            else
                throw new Exception ("Internal server error");
        }
    }

    public function remove( Sheet $sheet ) {
        $id = $sheet->getId();

        if ( $id ) {

            $request = "DELETE FROM sheet WHERE id=" . $id;
            $res = mysqli_query( $this->link, $request );
            if ( $res )
                return $sheet;
            else
                throw new Exception ("Internal server error");
        }
    }

    public function search( $s ) {
        $s = mysqli_real_escape_string( $this->link, $s );
        $s = '%' . $s . '%';

        $list = [];
        $request = "SELECT * FROM sheet WHERE title LIKE '" . $s . "' OR content LIKE '" . $s . "'";

        $res = mysqli_query( $this->link, $request );
        while ( $sheet = mysqli_fetch_object( $res, 'Sheet', array( $this->link ) ) )
            $list[] = $sheet;
        return $list;
    }
}
?>
