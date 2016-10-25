<?php
/**
* @file : GalleryManager.class.php
*
*/
class GalleryManager {

    private $link;
    private $select_offset;
    private $select_limit;

    public function __construct( $link, $select_offset = 0, $select_limit = 0 ) {
        $this->link          = $link;
        $this->select_offset = intval( $select_offset );
        $this->select_limit  = intval( $select_limit );
    }

    public function findAll() {
        $list = [];

        if ( $this->select_limit == 0 )
            $request = "SELECT * FROM gallery";
        else
            $request = "SELECT * FROM gallery ORDER BY id LIMIT " . $this->select_offset . "," . $this->select_limit;

        $res = mysqli_query( $this->link, $request );
        while ( $gallery = mysqli_fetch_object( $res, 'Gallery', array( $this->link ) ) )
            $list[] = $gallery;
        return $list;
    }

    public function countAll() {
         $request = "SELECT COUNT(*) FROM gallery";
         $res = mysqli_query( $this->link, $request );
         $count = mysqli_fetch_row( $res );

         return $count[0];
    }

    public function findAllByIdUser( $id_user) {
        $id_user = intval( $id_user );
        $list = [];

        if ( $this->select_limit == 0 )
            $request = "SELECT * FROM gallery WHERE id_user = " . $id_user;
        else
            $request = "SELECT * FROM gallery WHERE id_user = " . $id_user . " ORDER BY id LIMIT " . $this->select_offset . "," . $this->select_limit;
        $res = mysqli_query( $this->link, $request );
        while ( $gallery = mysqli_fetch_object( $res, 'Gallery', array( $this->link ) ) )
            $list[] = $gallery;
        return $list;
    }

    public function countAllByIdUser( $id_user ) {
         $id_user = intval( $id_user );
         $request = "SELECT COUNT(*) FROM gallery WHERE id_user = " . $id_user;
         $res = mysqli_query( $this->link, $request );
         $count = mysqli_fetch_row( $res );

         return $count[0];
    }

    public function findAllByIdArticle( $id_article ) {
        $id_article = intval( $id_article );
        $list = [];

        if ( $this->select_limit == 0 )
            $request = "SELECT * FROM gallery WHERE id_article = " . $id_article;
        else
            $request = "SELECT * FROM gallery WHERE id_article = " . $id_article . " ORDER BY id LIMIT " . $this->select_offset . "," . $this->select_limit;

        $res = mysqli_query( $this->link, $request );
        while ( $gallery = mysqli_fetch_object( $res, 'Gallery', array( $this->link ) ) )
            $list[] = $gallery;
        return $list;
    }

    public function countAllByIdArticle( $id_article ) {
        $id_article = intval( $id_article );
         $request = "SELECT COUNT(*) FROM gallery WHERE id_article = " . $id_article;
         $res = mysqli_query( $this->link, $request );
         $count = mysqli_fetch_row( $res );

         return $count[0];
    }

    public function findAllByIdUserByIdArticle( $id_user ) {
        $id_user     = intval( $id_user );
        $id_article  = intval( $id_article );
        $list = [];

        if ( $this->select_offset == 0 )
            $request = "SELECT * FROM gallery WHERE id_user = " . $id_user . " AND id_article = " . $id_article;
        else
            $request = "SELECT * FROM gallery WHERE id_user = " . $id_user . " AND id_article = " . $id_article . " ORDER BY id LIMIT " . $this->select_offset . "," . $this->select_limit;

        $res = mysqli_query( $this->link, $request );
        while ( $gallery = mysqli_fetch_object( $res, 'Gallery', array( $this->link ) ) )
            $list[] = $gallery;
        return $list;
    }

    public function countAllByIdUserIdArticle( $id_user, $id_article ) {
         $id_user = intval( $id_user );
         $id_article = intval( $id_article );
         $request = "SELECT COUNT(*) FROM gallery WHERE id_user = " . $id_user . " AND id_article = " . $id_article;
         $res = mysqli_query( $this->link, $request );
         $count = mysqli_fetch_row( $res );

         return $count[0];
    }

    public function findById( $id ) {
        $id = intval( $id );
        $request = "SELECT * FROM gallery WHERE id = " . $id;
        $res = mysqli_query( $this->link, $request );
        $gallery = mysqli_fetch_object( $res, 'Gallery', array( $this->link ) );
        return $gallery;
    }

    public function findFirst() {
        $request = "SELECT * FROM gallery LIMIT 1";
        $res = mysqli_query( $this->link, $request );
        $gallery = mysqli_fetch_object( $res, 'Gallery', array( $this->link ) );
        return $gallery;
    }

    public function findByUser( User $user ) {
        $list = [];
        $id = $user->getId();
        $request = "SELECT * FROM gallery WHERE id_user = " . $id;
        $res = mysqli_query( $this->link, $request );
        while ( $gallery = mysqli_fetch_object( $res, 'Gallery', array( $this->link ) ) )
            $list[] = $gallery;
        return $list;
    }


    public function create( $data,  Article $article, User $user ) {

        $gallery = new Gallery( $this->link );

        if ( !isset( $data['title'] ) ) throw new Exception ('Titre manquant');
        if ( !isset( $data['image'] ) ) throw new Exception ('Image manquante');

        $gallery->setTitle( $data['title'] );
        $gallery->setImage( $data['image'] );

        $id_user    = $user->getId();
        $article    = $article->getId();
        $title      = mysqli_real_escape_string( $this->link, $gallery->getTitle() );
        $image      = mysqli_real_escape_string( $this->link, $gallery->getImage() );

        $csv = "','";
        $request = "INSERT INTO gallery (id_user, id_article, title, image )
            VALUES('" . $id_user . $csv . $article . $csv . $title . $csv . $image ."')";

        $res = mysqli_query( $this->link, $request );

        if ( $res ) {
            $id = mysqli_insert_id( $this->link );

            if ( $id ) {
                $gallery = $this->findById( $id );
                return $gallery;
            }
            else
                throw new Exception ("Internal server error");
        }
        else
            throw new Exception ("Internal server error");

    }



    public function update( Gallery $gallery ) {

        $id = $gallery->getId();

        if ( $id ) {
            $id_user    = mysqli_real_escape_string( $this->link, $gallery->getIdUser() );
            $id_article = mysqli_real_escape_string( $this->link, $gallery->getIdArticle() );
            $title      = mysqli_real_escape_string( $this->link, $gallery->getTitle() );
            $image      = mysqli_real_escape_string( $this->link, $gallery->getImage() );

            $request = "UPDATE gallery SET id_user='" . $id_user . "', id_article='" .  $id_article . "', title='" . $title . "', image='" . $image . "' WHERE id=" . $id;

            $res = mysqli_query( $this->link, $request );
            if ( $res )
                return $this->findById( $id );
            else
                throw new Exception ("Internal server error");
        }
    }

    public function remove( Gallery $gallery ) {
        $id = $gallery->getId();

        if ( $id ) {

            $request = "DELETE FROM gallery WHERE id=" . $id;
            $res = mysqli_query( $this->link, $request );
            if ( $res )
                return $gallery;
            else
                throw new Exception ("Internal server error");
        }
    }

    public function search( $s ) {
        $s = mysqli_real_escape_string( $this->link, $s );
        $s = '%' . $s . '%';

        $list = [];
        $request = "SELECT * FROM gallery WHERE title LIKE '" . $s . "' OR content LIKE '" . $s . "'";

        $res = mysqli_query( $this->link, $request );
        while ( $gallery = mysqli_fetch_object( $res, 'Gallery', array( $this->link ) ) )
            $list[] = $gallery;
        return $list;
    }
}
?>
