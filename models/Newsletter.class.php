<?php
/**
* @file : Newsletter.class.php
*
*/
class Newsletter {

    private $id;
    private $id_sheet;
    private $title;
    private $file;
    private $date;


    private $link;
    private $sheet;


    public function __construct( $link ) {
        $this->link = $link;
    }


    public function getSheet() {
        if ( $this->sheet === null ) {
            $manager = new SheetManager( $this->link );
            $this->sheet = $manager->findById( $this->id_sheet );
        }

        return $this->sheet;
    }


    public function getId() {
        return $this->id;
    }


    public function getIdSheet() {
        return $this->id_sheet;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getFile() {
        return $this->file;
    }


    public function getDate() {
        return $this->date;
    }


    public function setIdSheet( $id_sheet ) {
       $id_sheet = intval( $id_sheet );

       $this->id_sheet = $id_sheet;
    }

    public function setTitle( $title ) {
          if ( strlen( $title ) < 3 )
            throw new Exception ("titre trop courte (< 3)");
        else if ( strlen( $title ) > 127 )
            throw new Exception ("titre trop longue (> 127)");

        $this->title = $title;
    }

    public function setFile( $file ) {

        $this->file = $file;
    }

}

?>