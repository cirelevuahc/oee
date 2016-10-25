<?php
    $list_nav_page_next = $list_nav_page + 1;

    if ( $list_nav_page_next  < $list_nav_total ) {
        $list_nav_link_next = $list_nav_name . '_id_' . $id_article . '_pg_' . $list_nav_page_next;
        require('views/admin/list-nav-next.phtml');
    } else {
        require('views/admin/list-nav-next-inactive.phtml');
    }


?>