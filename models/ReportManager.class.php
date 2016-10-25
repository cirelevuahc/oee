<?php
/**
* @file : ReportManager.class.php
*
*/
class ReportManager {

    private $link;

    public function __construct( $link ) {
        $this->link = $link;
    }

    public function findAll() {
        $list = [];
        $request = "SELECT * FROM report";
        $res = mysqli_query( $this->link, $request );
        while ( $report = mysqli_fetch_object( $res, 'Report', array( $this->link ) ) )
            $list[] = $report;
        return $list;
    }

    public function findById( $id ) {
        $id = intval( $id );
        $request = "SELECT * FROM report WHERE id = " . $id;
        $res = mysqli_query( $this->link, $request );
        $report = mysqli_fetch_object( $res, 'Report', array( $this->link ) );
        return $report;
    }

    public function findFirst() {
        $request = "SELECT * FROM report LIMIT 1";
        $res = mysqli_query( $this->link, $request );
        $report = mysqli_fetch_object( $res, 'Report', array( $this->link ) );
        return $report;
    }

    public function findBySheet( Sheet $sheet ) {
        $list = [];
        $id = $sheet->getId();
        $request = "SELECT * FROM report WHERE id_sheet = " . $id;
        $res = mysqli_query( $this->link, $request );
        while ( $sheet = mysqli_fetch_object( $res, 'Report', array( $this->link ) ) )
            $list[] = $sheet;
        return $list;
    }

    public function create( $data, Sheet $sheet ) {

        $report = new Report( $this->link );

        if ( !isset( $data['title'] ) ) throw new Exception ('Titre manquant');
        if ( !isset( $data['file'] ) ) throw new Exception ('Fichier manquant');

        $report->setTitle( $data['title'] );
        $report->setFile( $data['file'] );

        $id_sheet = $sheet->getId();
        $title       = mysqli_real_escape_string( $this->link, $report->getTitle() );
        $file        = mysqli_real_escape_string( $this->link, $report->getFile() );

        $csv = "','";
        $request = "INSERT INTO report ( id_sheet, title, file )
            VALUES('" . $id_sheet . $csv . $title . $csv . $file ."')";

        $res = mysqli_query( $this->link, $request );

        if ( $res ) {
            $id = mysqli_insert_id( $this->link );

            if ( $id ) {
                $report = $this->findById( $id );
                return $report;
            }
            else
                throw new Exception ("Internal server error");
        }
        else
            throw new Exception ("Internal server error");

    }



    public function update( Report $report ) {

        $id = $report->getId();

        if ( $id ) {

            $id_sheet    = mysqli_real_escape_string( $this->link, $report->getIdSheet() );
            $title          = mysqli_real_escape_string( $this->link, $report->getTitle() );
            $file           = mysqli_real_escape_string( $this->link, $report->getFile() );

            $request = "UPDATE report SET id_sheet='" . $id_sheet . "', title='" . $title . "', file='" . $file  . "' WHERE id=" . $id;


            $res = mysqli_query( $this->link, $request );
            if ( $res )
                return $this->findById( $id );
            else
                throw new Exception ("Internal server error");
        }
    }

    public function remove( Report $report ) {
        $id = $report->getId();

        if ( $id ) {

            $request = "DELETE FROM report WHERE id=" . $id;
            $res = mysqli_query( $this->link, $request );
            if ( $res )
                return $report;
            else
                throw new Exception ("Internal server error");
        }
    }

    public function search( $s ) {
        $s = mysqli_real_escape_string( $this->link, $s );
        $s = '%' . $s . '%';

        $list = [];
        $request = "SELECT * FROM report WHERE title LIKE '" . $s . "' OR file LIKE '" . $s . "'";

        $res = mysqli_query( $this->link, $request );
        while ( $report = mysqli_fetch_object( $res, 'Report', array( $this->link ) ) )
            $list[] = $report;
        return $list;
    }
}
?>
