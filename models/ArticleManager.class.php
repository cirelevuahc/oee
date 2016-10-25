<?php
/**
* @file : ArticleManager.class.php
*
*/
class ArticleManager {

    private $link;

    public function __construct( $link ) {
        $this->link = $link;
    }

    public function findAll() {
        $list = [];
        $request = "SELECT * FROM article";
        $res = mysqli_query( $this->link, $request );
        while ( $article = mysqli_fetch_object( $res, 'Article', array( $this->link ) ) )
            $list[] = $article;
        return $list;
    }

    public function findAllByIdUser( $id_user ) {
        $id_user = intval( $id_user );
        $list = [];
        $request = "SELECT * FROM article WHERE id_user = " . $id_user;
        $res = mysqli_query( $this->link, $request );
        while ( $article = mysqli_fetch_object( $res, 'Article', array( $this->link ) ) )
            $list[] = $article;
        return $list;
    }

    public function findById( $id ) {
        $id = intval( $id );
        $request = "SELECT * FROM article WHERE id = " . $id;
        $res = mysqli_query( $this->link, $request );
        $article = mysqli_fetch_object( $res, 'Article', array( $this->link ) );
        return $article;
    }

    public function findFirst() {
        $request = "SELECT * FROM article LIMIT 1";
        $res = mysqli_query( $this->link, $request );
        $article = mysqli_fetch_object( $res, 'Article', array( $this->link ) );
        return $article;
    }

    public function findBySheet( Sheet $sheet ) {
        $list = [];
        $id = $sheet->getId();
        $request = "SELECT * FROM article WHERE id_sheet = " . $id . " ORDER BY id DESC";
        $res = mysqli_query( $this->link, $request );
        while ( $sheet = mysqli_fetch_object( $res, 'Article', array( $this->link ) ) )
            $list[] = $sheet;
        return $list;
    }

    public function findByUser( User $user ) {
        $list = [];
        $id = $user->getId();
        $request = "SELECT * FROM article WHERE id_user = " . $id;
        $res = mysqli_query( $this->link, $request );
        while ( $sheet = mysqli_fetch_object( $res, 'Article', array( $this->link ) ) )
            $list[] = $sheet;
        return $list;
    }

    public function create( $data, User $user, Sheet $sheet ) {

        $article = new Article( $this->link );

        if ( !isset( $data['title'] ) ) throw new Exception ('Titre manquant');
        if ( !isset( $data['content'] ) ) throw new Exception ('Contenu manquant');
        if ( !isset( $data['image'] ) ) throw new Exception ('Image manquante');
        if ( !isset( $data['video'] ) ) throw new Exception ('Vidéo manquante' );

        $article->setTitle( $data['title'] );
        $article->setContent( $data['content'] );
        $article->setImage( $data['image'] );
        $article->setVideo( $data['video'] );
        $article->setGallery( $data['gallery'] );

        $id_user        = $user->getId();
        $id_sheet    = $sheet->getId();
        $title          = mysqli_real_escape_string( $this->link, $article->getTitle() );
        $content        = mysqli_real_escape_string( $this->link, $article->getContent() );
        $image          = mysqli_real_escape_string( $this->link, $article->getImage() );
        $video          = mysqli_real_escape_string( $this->link, $article->getVideo() );
        $gallery        = mysqli_real_escape_string( $this->link, $article->getGallery() );

        $csv = "','";
        $request = "INSERT INTO article (id_user, id_sheet, title, content, image, video, gallery )
            VALUES('" . $id_user . $csv . $id_sheet . $csv . $title . $csv . $content . $csv . $image . $csv . $video . $csv . $gallery ."')";

        $res = mysqli_query( $this->link, $request );

        if ( $res ) {
            $id = mysqli_insert_id( $this->link );

            if ( $id ) {
                $article = $this->findById( $id );
                return $article;
            } else
                throw new Exception ("Internal server error");
        }
        else
            throw new Exception ("Internal server error");

    }

    public function update( Article $article ) {

        $id = $article->getId();

        if ( $id ) {
            $id_user        = mysqli_real_escape_string( $this->link, $article->getIdUser() );
            $id_sheet       = mysqli_real_escape_string( $this->link, $article->getIdSheet() );
            $title          = mysqli_real_escape_string( $this->link, $article->getTitle() );
            $content        = mysqli_real_escape_string( $this->link, $article->getContent() );
            $image          = mysqli_real_escape_string( $this->link, $article->getImage() );
            $video          = mysqli_real_escape_string( $this->link, $article->getVideo() );
            $gallery        = mysqli_real_escape_string( $this->link, $article->getGallery() );


            $request = "UPDATE article SET id_user='" . $id_user . "', id_sheet='" . $id_sheet . "', title='" . $title . "', content='" . $content . "', image='" . $image . "', video='" . $video . "', gallery='" . $gallery . "' WHERE id=" . $id;


            $res = mysqli_query( $this->link, $request );
            if ( $res )
                return $this->findById( $id );
            else
                throw new Exception ("Internal server error");
        }
    }

    public function remove( Article $article ) {
        $id = $article->getId();

        if ( $id ) {

            $request = "DELETE FROM article WHERE id=" . $id;

            $res = mysqli_query( $this->link, $request );
            if ( $res )
                return $article; // ou true
            else
                throw new Exception ("Internal server error");
        }
    }

    public function search( $s ) {
        $s = mysqli_real_escape_string( $this->link, $s );
        $s = '%' . $s . '%';

        $list = [];
        $request = "SELECT * FROM article WHERE title LIKE '" . $s . "' OR content LIKE '" . $s . "'";

        $res = mysqli_query( $this->link, $request );
        while ( $article = mysqli_fetch_object( $res, 'Article', array( $this->link ) ) )
            $list[] = $article;
        return $list;
    }
}
?>
