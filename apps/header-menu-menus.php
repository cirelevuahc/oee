<?php

    $manager = new SheetManager( $link );
    $sheets  = $manager->findAll('menu_order');

    $menus_limit      = intval( $SETTINGS->findByName('menu-limit')->getValue() );
    $menus_count      = 0;
    $menus_index      = 0;
    $menus_list_index = 0;
    $menus            = array();
    $sub_menus        = array();
    $menus_list       = array();

    // Create a list from evey sheet page.
    $i          = 0;
    $count      = count( $sheets );
    while ( $i < $count ) {
        $sheet = $sheets[$i];

        if ( $sheet->getMenuOrder() > 0 ) {
            $menus_list[$menus_list_index]['id']    = 'sheet_id_' . $sheet->getId();
            $menus_list[$menus_list_index]['title'] = $sheet->getTitle();

            $menus_list_index++;
        }

        $i++;
    }

    // Add default page.
    if ( $menus_list_index == 0 ) {
        $menus_list[$menus_list_index]['id']    = 'welcome';
        $menus_list[$menus_list_index]['title'] = 'Bienvenue';

        $menus_list_index++;

    } else {
        if ( $page == 'welcome') {
            // Change first page displayed, use first sheet.
            $ml = explode( '_', $menus_list[0]['id'] );
            $page       = $ml[0];
            $_GET['id'] = $ml[2];
        }
    }

    // Add contact page.
    $menus_list[$menus_list_index]['id'] = 'contact';
    $menus_list[$menus_list_index]['title'] = 'Contact';

    $menus_list_index++;

    // Add login or logout page.
    if ( isset( $_SESSION['user']['status'] ) && $_SESSION['user']['status'] == 1 ) {
        $menus_list[$menus_list_index]['id']    = 'logout';
        $menus_list[$menus_list_index]['title'] = 'Logout';

        $menus_list_index++;

    } else {
        $menus_list[$menus_list_index]['id']    = 'login';
        $menus_list[$menus_list_index]['title'] = 'Login';

        $menus_list_index++;
    }

    // Rearrange menu.
    $i          = 0;
    $count      = count( $menus_list );
    while ( $i < $count ) {
        $menu = $menus_list[$i];


        if ( $menus_count < $menus_limit ) {
            $menus[$menus_index]['id']    = $menu['id'];
            $menus[$menus_index]['title'] = $menu['title'];
        }

        if ( $menus_count == $menus_limit ) {
            $menus_index = 0;
            $sub_menus[$menus_index]['id'] = $menus[$menus_limit - 1]['id'];
            $sub_menus[$menus_index]['title'] = $menus[$menus_limit - 1]['title'];

            $menus[$menus_limit - 1]['id']    = '';
            $menus[$menus_limit - 1]['title'] = '...';
            $menus_index++;
        }

        if ( $menus_count >= $menus_limit ) {
            $sub_menus[$menus_index]['id']    = $menu['id'];
            $sub_menus[$menus_index]['title'] = $menu['title'];
        }

        $menus_count++;
        $menus_index++;


        $i++;
    }

    $i           = 0;
    $count_menus = count( $menus );

    while ( $i < $count_menus ) {
        $menu = $menus[$i];
        $menu_as_children = '';
        if ( $i == ( $menus_limit - 1 ) && !empty( $sub_menus ) )
            $menu_as_children = 'menu-has-children';

        require('views/header-menu-menus.phtml');

        $i++;
    }


?>