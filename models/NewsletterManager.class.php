<?php
/**
* @file : NewsletterManager.class.php
*
*/
class NewsletterManager {

    private $link;

    public function __construct( $link ) {
        $this->link = $link;
    }

    public function findAll() {
        $list = [];
        $request = "SELECT * FROM newsletter";
        $res = mysqli_query( $this->link, $request );
        while ( $newsletter = mysqli_fetch_object( $res, 'Newsletter', array( $this->link ) ) )
            $list[] = $newsletter;
        return $list;
    }

    public function findById( $id ) {
        $id = intval( $id );
        $request = "SELECT * FROM newsletter WHERE id = " . $id;
        $res = mysqli_query( $this->link, $request );
        $newsletter = mysqli_fetch_object( $res, 'Newsletter', array( $this->link ) );
        return $newsletter;
    }

    public function findFirst() {
        $request = "SELECT * FROM newsletter LIMIT 1";
        $res = mysqli_query( $this->link, $request );
        $newsletter = mysqli_fetch_object( $res, 'Newsletter', array( $this->link ) );
        return $newsletter;
    }

    public function findBySheet( Sheet $sheet ) {
        $list = [];
        $id = $sheet->getId();
        $request = "SELECT * FROM newsletter WHERE id_sheet = " . $id;
        $res = mysqli_query( $this->link, $request );
        while ( $sheet = mysqli_fetch_object( $res, 'Newsletter', array( $this->link ) ) )
            $list[] = $sheet;
        return $list;
    }

    public function create( $data, Sheet $sheet ) {

        $newsletter = new Newsletter( $this->link );

        if ( !isset( $data['title'] ) ) throw new Exception ('Titre manquant');
        if ( !isset( $data['file'] ) ) throw new Exception ('Fichier manquant');

        $newsletter->setTitle( $data['title'] );
        $newsletter->setFile( $data['file'] );

        $id_sheet = $sheet->getId();
        $title       = mysqli_real_escape_string( $this->link, $newsletter->getTitle() );
        $file        = mysqli_real_escape_string( $this->link, $newsletter->getFile() );

        $csv = "','";
        $request = "INSERT INTO newsletter ( id_sheet, title, file )
            VALUES('" . $id_sheet . $csv . $title . $csv . $file ."')";

        $res = mysqli_query( $this->link, $request );

        if ( $res ) {
            $id = mysqli_insert_id( $this->link );

            if ( $id ) {
                $newsletter = $this->findById( $id );
                return $newsletter;
            }
            else
                throw new Exception ("Internal server error");
        }
        else
            throw new Exception ("Internal server error");

    }



    public function update( Newsletter $newsletter ) {

        $id = $newsletter->getId();

        if ( $id ) {

            $id_sheet    = mysqli_real_escape_string( $this->link, $newsletter->getIdSheet() );
            $title          = mysqli_real_escape_string( $this->link, $newsletter->getTitle() );
            $file           = mysqli_real_escape_string( $this->link, $newsletter->getFile() );

            $request = "UPDATE newsletter SET id_sheet='" . $id_sheet . "', title='" . $title . "', file='" . $file  . "' WHERE id=" . $id;


            $res = mysqli_query( $this->link, $request );
            if ( $res )
                return $this->findById( $id );
            else
                throw new Exception ("Internal server error");
        }
    }

    public function remove( Newsletter $newsletter ) {
        $id = $newsletter->getId();

        if ( $id ) {

            $request = "DELETE FROM newsletter WHERE id=" . $id;
            $res = mysqli_query( $this->link, $request );
            if ( $res )
                return $newsletter;
            else
                throw new Exception ("Internal server error");
        }
    }

    public function search( $s ) {
        $s = mysqli_real_escape_string( $this->link, $s );
        $s = '%' . $s . '%';

        $list = [];
        $request = "SELECT * FROM newsletter WHERE title LIKE '" . $s . "' OR file LIKE '" . $s . "'";

        $res = mysqli_query( $this->link, $request );
        while ( $newsletter = mysqli_fetch_object( $res, 'Newsletter', array( $this->link ) ) )
            $list[] = $newsletter;
        return $list;
    }
}
?>
