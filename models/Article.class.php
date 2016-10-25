<?php
/**
* @file : Article.class.php
*
*/
class Article {

    private $id;
    private $id_user;
    private $id_sheet;
    private $title;
    private $content;
    private $image;
    private $video;
    private $date;
    private $gallery;

    private $link;
    private $comment;
    private $user;
    private $sheet;


    public function __construct( $link ) {
        $this->link = $link;
    }


    public function getComment() {
        if ( $this->comment === null ) {
            $manager = new CommentManager( $this->link );
            $this->comment = $manager->findByArticle( $this );
        }

        return $this->comment;
    }

    public function getUser() {
        if ( $this->user === null ) {
            $manager = new UserManager( $this->link );
            $this->user = $manager->findById( $this->id_user );
        }

        return $this->user;
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

    public function getIdUser() {
        return $this->id_user;
    }

    public function getIdSheet() {
        return $this->id_sheet;
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

    public function getGallery() {
        return $this->gallery;
    }

    public function setIdUser( $id_user ) {
        $id_user = intval( $id_user );

        $this->id_user = $id_user;
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

    public function setContent( $content ) {
        if ( strlen( $content ) < 3 )
            throw new Exception ("description trop courte (< 3)");
        else if ( strlen( $content ) > 2047 )
            throw new Exception ("description trop longue (> 2047)");

        $this->content = $content;
    }

    public function setImage( $image ) {

        $this->image = $image;
    }

    public function setVideo( $video ) {

        $this->video = $video;
    }

    public function setGallery( $gallery ) {

        $this->gallery = $gallery;
    }
}

?>