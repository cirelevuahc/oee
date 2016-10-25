<?php
    /**
     * name : oee
     * author : Eric Chauvel
     * version : 1.5
     * date : 2016/10
     */

    session_start();

    require('apps/config.php');
    require('apps/debug.php');
    require('apps/functions.php');
    require('apps/db.php');

    $page        = 'welcome';
    $page_source = 'user';

    $message['type']    = '';
    $message['content'] = '';

    $SETTINGS = new SettingManager( $link );

    $MAINTENANCE = false;
    if ( $SETTINGS->findByName('maintenance')->getValue() == 1 ) {
        $MAINTENANCE = true;
        $page = 'maintenance';
    }

    $ACCESS_ADMIN = false;
    if ( isset( $_SESSION['user']['capability']['access_admin'] ) && $_SESSION['user']['capability']['access_admin'] == 1 )
        $ACCESS_ADMIN = true;

    if ( isset( $_SESSION['message'] ) ) {
        $message['type']    = ucfirst( $_SESSION['message']['type'] );
        $message['content'] = $_SESSION['message']['content'];

        unset( $_SESSION['message'] );
    }

    $access = array(
        'welcome',
        'login',
        'logout',
        'register',
        'register-message',
        'register-confirm',
        'contact',
        'sheet',
        'article-detail',
        'newsletters',
        'newsletter-detail',
        'reports',
        'report-detail',
    );

    $access_admin = array(
        'home',
        'logout',
        'users',
        'user-edit',
        'user-edit-single',
        'articles',
        'article-edit',
        'sheets',
        'sheet-edit',
        'manage-menus',
        'galleries',
        'gallery-edit',
        'newsletters',
        'newsletter-edit',
        'reports',
        'report-edit',
        'settings',
    );

    $access_treatment = array(
        'login'                     => 'user',
        'ec-login'                  => 'user',
        'logout'                    => 'user',
        'register'                  => 'user',
        'register-confirm'          => 'user',
        'users'                     => 'user',
        'user-edit'                 => 'user',
        'user-edit-single'          => 'user',
        'articles'                  => 'article',
        'article-edit'              => 'article',
        'sheets'                    => 'sheet',
        'sheet-edit'                => 'sheet',
        'manage-menus'              => 'sheet',
        'article-detail'            => 'comment',
        'newsletters'               => 'newsletter',
        'newsletter-edit'           => 'newsletter',
        'contact'                   => 'contact',
        'galleries'                 => 'gallery',
        'gallery-edit'              => 'gallery',
        'reports'                   => 'report',
        'report-edit'               => 'report',
        'settings'                  => 'setting',
    );

    $access_ajax = array(
        'newsletter-detail',
        'report-detail',
    );

    $access_maintenance = array(
        'maintenance',
        'ec-login',
    );

    if ( isset( $_GET['page'] ) && $MAINTENANCE ) {
        if ( in_array( $_GET['page'], $access_maintenance ) ) {
            $page        = $_GET['page'];
            $page_source = 'maintenance';
        }
    }

    if ( ( isset( $_GET['page'] ) && !$MAINTENANCE ) || $ACCESS_ADMIN ) {
        if ( in_array( $_GET['page'], $access ) ) {
            $page        = $_GET['page'];
            $page_source = 'user';
        }
    }

    if ( isset( $_GET['page'] ) ) {
        if ( $ACCESS_ADMIN ) {
            if ( in_array( $_GET['page'], $access_admin ) ) {
                $page        = $_GET['page'];
                $page_source = 'admin';
            }
        }
    }

    if ( isset( $access_treatment[$page] ) ) {
        require('apps/treatment/treatment-' . $access_treatment[$page] . '.php' );
    }

    if ( isset( $_GET['ajax'] ) ) {
        if ( in_array( $page, $access_ajax ) ) {
            require('apps/' . $page . '.php');
        }
    } else {
        if ( $ACCESS_ADMIN && $page_source == 'admin' ) {
            require('apps/admin/skel.php');
        } else {
            if ( in_array( $page, $access_maintenance ) )
                require('apps/maintenance/skel.php');
            else
                require('apps/skel.php');
        }
    }


?>