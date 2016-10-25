<?php
    $list_nav_page_prev = $list_nav_page - 1;

    if ( $list_nav_page_prev >= 0 ) {
        $list_nav_link_prev = $list_nav_name . '_id_' . $id_article . '_pg_' . $list_nav_page_prev;
        require('views/admin/list-nav-prev.phtml');
    } else {
        require('views/admin/list-nav-prev-inactive.phtml');
    }




?>