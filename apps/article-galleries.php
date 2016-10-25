<?php

    if ( $article->getGallery() == 0 ) return;

    $manager = new GalleryManager( $link );

    $galleries = $manager->findAllByIdArticle( $article->getId() );

    if ( !empty( $galleries ) ) {

        $svg_icon   = new SvgIcon();
        $zoom_plus  = $svg_icon->display( IMAGE_PATH . '/zoom-plus.svg', 'ec_gallery_zoom_plus_' . $article->getId(),'gallery-zoom-button', false, false );
        $zoom_minus = $svg_icon->display( IMAGE_PATH . '/zoom-minus.svg', 'ec_gallery_zoom_minus_' . $article->getId(),'gallery-zoom-button', false, false );

        require('views/article-galleries.phtml');
    }
?>