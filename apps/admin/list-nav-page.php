<?php
    $i = 0;
    while ( $i < $list_nav_total ) {
        $list_nav_page_display = $i + 1;
        $list_nav_link = $list_nav_name . '_id_' . $id_article . '_pg_' . $i;

        require('views/admin/list-nav-page.phtml');

        $i++;
    }

?>