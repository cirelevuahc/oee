<?php
/**
* @file : Sheet.class.php
*
*/
class Sheet {

    private $id;
    private $id_user;
    private $title;
    private $content;
    private $image;
    private $video;
    private $date;
    private $menu_order;
    private $newsletter;
    private $report;

    private $link;
    private $user;


    public function __construct( $link ) {
        $this->link = $link;
    }


    public function getUser() {
        if ( $this->user === null ) {
            $manager = new UserManager( $this->link );
            $this->user = $manager->findById( $this->id_user );
        }

        return $this->user;
    }


    public function getId() {
        return $this->id;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getImage() {
        return $this->image;
    }

    public function getvideo() {
        return $this->video;
    }

    public function getDate() {
        return $this->date;
    }

    public function getMenuOrder() {
        return $this->menu_order;
    }

    public function getNewsletter() {
        return $this->newsletter;
    }

    public function getReport() {
        return $this->report;
    }

    public function setIdUser( $id_user ) {
        $id_user = intval( $id_user );

        $this->id_user = $id_user;
    }

    public function setTitle( $title ) {
          if ( strlen( $title ) < 3 )
            throw new Exception ("description trop courte (< 3)");
        else if ( strlen( $title ) > 63 )
            throw new Exception ("description trop longue (> 63)");

        $this->title = $title;
    }

    public function setContent( $content ) {

        $this->content = $content;
    }

    public function setImage( $image ) {

        $this->image = $image;
    }

    public function setVideo( $video ) {
        //if ( filter_var( $video, FILTER_VALIDATE_URL ) == false )
        //    throw new Exception ("Ce n'est pas une URL valide");

        $this->video = $video;
    }

    public function setMenuOrder( $menu_order ) {
        $menu_order = intval( $menu_order );

        $this->menu_order = $menu_order;
    }

    public function setNewsletter( $newsletter ) {
        $newsletter = intval( $newsletter );

        $this->newsletter = $newsletter;
    }

    public function setReport( $report ) {
        $report = intval( $report );

        $this->report = $report;
    }
}

?>