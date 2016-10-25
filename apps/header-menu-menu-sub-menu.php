<?php
    $j               = 0;
    $count_sub_menus = count( $sub_menus );
    while ( $j < $count_sub_menus ) {
        $sub_menu = $sub_menus[$j];

        require('views/header-menu-menu-sub-menu.phtml');

        $j++;
    }
?>