<?php
    if ( $list_nav_page > 1 ) {
        $list_nav_link_first = $list_nav_name . '_id_' . $id_article . '_pg_0';
        require('views/admin/list-nav-first.phtml');
    } else {
        require('views/admin/list-nav-first-inactive.phtml');
    }

?>