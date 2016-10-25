<?php
    if ( $list_nav_total > 1 ) {
        require('views/admin/list-nav-pages.phtml');
    } else {
        $list_nav_page_display = $list_nav_page + 1;
        require('views/admin/list-nav-pages-one.phtml');
    }
?>