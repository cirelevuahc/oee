<?php
    $list_nav_page = 0;

    if ( isset( $_GET['pg'] ) ) $list_nav_page = intval( $_GET['pg'] );

    $list_nav_total = ceil( $list_nav_count / $select_limit );

    if ( $list_nav_page < 0 ) $list_nav_page = 0;

    if ( $list_nav_page != 0 && $list_nav_page >= $list_nav_total ) $list_nav_page = $list_nav_total - 1;

    $select_offset = $list_nav_page * $select_limit;

?>