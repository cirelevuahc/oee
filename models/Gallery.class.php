<?php
/**
* @file : Sheet.class.php
*
*/
class Gallery {

    private $id;
    private $id_user;
    private $id_article;
    private $title;
    private $image;
    private $date;


    private $link;
    private $user;
    private $article;

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

    public function getArticle() {
        if ( $this->article === null ) {
            $manager = new ArticleManager( $this->link );
            $this->article = $manager->findById( $this->id_article );
        }

        return $this->article;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function getIdArticle() {
        return $this->id_article;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDate() {
        return $this->date;
    }

    public function setIdUser( $id_user ) {
        $id_user = intval( $id_user );

        $this->id_user = $id_user;
    }

    public function setIdArticle( $id_article ) {
        $id_article = intval( $id_article );

        $this->id_article = $id_article;
    }

    public function setTitle( $title ) {
          if ( strlen( $title ) < 3 )
            throw new Exception ("description trop courte (< 3)");
        else if ( strlen( $title ) > 63 )
            throw new Exception ("description trop longue (> 63)");

        $this->title = $title;
    }

    public function setImage( $image ) {

        $this->image = $image;
    }


}

?>