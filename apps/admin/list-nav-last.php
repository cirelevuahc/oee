<?php
    if ( $list_nav_page < ( $list_nav_total - 2 ) ) {
        $list_nav_link_last = $list_nav_name . '_id_' . $id_article . '_pg_' . ( $list_nav_total - 1 );
        require('views/admin/list-nav-last.phtml');
    } else {
        require('views/admin/list-nav-last-inactive.phtml');
    }
?>