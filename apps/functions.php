<?php
    require('models/SvgIcon.class.php');

    /**
     * @param string $class_name
     */
    function __autoload( $class_name ) {
        require('models/' . $class_name . '.class.php' );
    }

    /**
     * Used for HTML tag input with attribut type radio and checkbox.
     *
     * @param string $checked
     * @param string $current
     *
     * @return string
     */
    function checked( $checked, $current ) {
        if ( $checked == $current ) return 'checked';
            else return '';
    }

    /**
     * Used for HTML tag select
     *
     * @param string $checked
     * @param string $current
     *
     * @return string
     */
    function selected( $selected, $current ) {
        if ( $selected == $current ) return 'selected';
            else return '';
    }

    /**
     * Check current page to select side menu.
     *
     * @param array/string $page
     * @param string $current_page
     */
    function side_menu_select( $page, $current_page ) {
        if ( is_array( $page ) ) {
            $i = 0;
            $count = count( $page );
            while( $i < $count ) {
                if ( $page[$i] == $current_page ) return 'side-menu_select';
                $i++;
            }
        } else
            if ( $page == $current_page ) return 'side-menu_select';

    }

    /**
     * Check current page to display side submenu.
     *
     * @param array/string $page
     * @param string $current_page
     */
    function side_menu_sub_menu_display( $page, $current_page ) {
        if ( is_array( $page ) ) {
            $i = 0;
            $count = count( $page );
            while( $i < $count ) {
                if ( $page[$i] == $current_page ) return 'side-menu-sub-menu_display';
                $i++;
            }
        } else
            if ( $page == $current_page ) return 'side-menu-sub-menu_display';

    }

    /**
     * Check current page to select side submenu.
     *
     * @param string $page
     * @param string $current_page
     */
    function side_menu_sub_menu_select( $page, $current_page ) {
        $id = 0;
        if ( isset( $_GET['id'] ) ) $id = $_GET['id'];

        if ( $page == $current_page && $id == 0 ) return 'side-menu-sub-menu_select';
    }

    /**
     * Convert date format from sql to php
     *
     * @param string $sql
     */
    function sql_2_date( $sql ){
        return date( 'd/m/Y', strtotime( $sql ) );
    }

    /**
     * Convert date format from php to sql
     *
     * @param string $date
     */
    function date_2_sql( $date ){
        $date = str_replace( '/', '-', $date );
        return date( 'Y-m-d', strtotime( $date ) );
    }

    /**
     * Check correct file name.
     *
     * @param string $file
     *
     * @return string $file
     */
    function check_file_name( $file ) {

        $file = strtr( $file,
            ' ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ',
            '-AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn' );

        $file =  strtolower( $file ) ;

        $s = array( '\'', '"' );
        $r = array( '', '' );
        $file = str_replace( $s, $r, $file );

        return $file;
    }

    /**
     * Send mail for register confirmation.
     * @param object $user
     * @param string $bcc
     */
    function send_register_confirmation( USER $user, $bcc, $site_name ) {

        $to   = $user->getEmail();
        $href = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '-confirm_rc_' . $user->getRegisterConfirm();

        $subject = 'Confirmation de votre adresse mail';

        $message = '
        <html>
            <head>
                <meta charset="UTF-8">
                <title>Confirmation de votre adress mail</title>
            </head>
            <body>
                <h1>Confirmation de votre adresse mail</h1>
                <p>Bonjour ' . $user->getForname() . ' ' . $user->getName() . '</p>
                <p>Vous avez fait une demande de création de compte sur le site ' . $site_name . '</p>
                <p>Pour finaliser votre inscription et confirmer votre adresse mail cliquez sur le lien si dessous</p>
                <a href="' . $href . '">' . $href . '</a>
            </body>
        </html>
        ';

        //__/ Entête.
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'To:' . $to . "\r\n";
        $headers .= 'From: ' . $site_name . "\r\n";
        $headers .= 'Cc:' . "\r\n";
        $headers .= 'Bcc:' . $bcc . "\r\n";
        
        mail( $to, $subject, $message, $headers );

    }

    /**
     * Send mail for contact.
     *
     * @param object $user
     * @param string $bcc
     */
    function send_message( $to, $name, $forname, $email, $message, $site_name ) {

        $subject = $site_name . ', message de ' . $forname . ' ' . $name;

        $message = '
        <html>
            <head>
                <meta charset="UTF-8">
                <title>' . $site_name . ', message</title>
            </head>
            <body>
                <h1>Message de ' . $forname . ' ' . $name . '</h1>
                <p>email : ' . $email . '</p>
                <p>' . $message . '</p>
            </body>
        </html>
        ';

        //__/ Entête.
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'To:' . $to . "\r\n";
        $headers .= 'From: ' . $site_name . "\r\n";
        $headers .= 'Cc:' . "\r\n";
        $headers .= 'Bcc:' . "\r\n";

        mail( $to, $subject, $message, $headers );

    }

    /**
     *
     */
    function upload_image( $target = '' ) {
        $target_dir      = 'public/uploads/';
        if ( $target != '' )  $target_dir .= $target . '/';
        $target_file     = $target_dir . basename( $_FILES['image_upload']['name'] );
        $target_file     = check_file_name( $target_file );

        $message = array(
            'type'    => '',
            'content' => '',
        );

        $upload_ok = 1;
        $image_file_type = pathinfo( $target_file, PATHINFO_EXTENSION );

        // Check if image file is a actual image or fake image
         $check = getimagesize( $_FILES['image_upload']['tmp_name'] );
         if( $check !== false ) {
             $upload_ok = 1;
         } else {
            $message['type']    = 'erreur';
            $message['content'] = 'Ce fichier n\'est pas une image valide.';

            $upload_ok = 0;
         }

        // Check if file already exists
        if ( file_exists( $target_file ) ) {
            $message['type']    = 'alert';
            $message['content'] = 'Une image avec le même nom existe déjà sur le serveur et sera utilisée.';

            $_POST['image'] = $target_file;
            $upload_ok = 0;
        } else {
            // Check file size
            if ( $_FILES['image_upload']['size'] > 500000 ) {
                $message['type']    = 'erreur';
                $message['content'] = 'Taille de l\'image trop grande ( > 500000).';

                $upload_ok = 0;
            }
            // Allow certain file formats
            $valides_extensions = array( 'jpg', 'jpeg', 'gif', 'png' );

            if ( !in_array( $image_file_type, $valides_extensions ) ) {
                $message['type']    = 'erreur';
                $message['content'] = 'Uniquement des images de type JPG, JPEG, PNG & GIF.';

                $upload_ok = 0;
            }

            // Check if $upload_ok is set to 0 by an error
            if ( $upload_ok == 1 ) {
                if ( move_uploaded_file( $_FILES['image_upload']['tmp_name'], $target_file ) ) {
                    $_POST['image'] = $target_file;
                } else {
                    $message['type']    = 'erreur';
                    $message['content'] = 'L\'image '. basename( $_FILES['image_upload']['name']). ' n\'a été correctement chargée.';

                }
            }
        }

        return $message;
    }


    /**
     *
     */
    function upload_video() {
        $target_dir  = 'public/uploads/';
        $target_file = $target_dir . basename( $_FILES['video_upload']['name'] );
        $target_file = check_file_name( $target_file );

        $message = array(
            'type'    => '',
            'content' => '',
        );
        $upload_ok = 1;
        $video_file_type = pathinfo( $target_file, PATHINFO_EXTENSION );

        // Check if file already exists
        if ( file_exists( $target_file ) ) {
            $message['type']    = 'alert';
            $message['content'] = 'Une vidéo avec le même nom existe déjà sur le serveur et sera utilisée.';

            $_POST['video'] = $target_file;
            $upload_ok = 0;
        } else {
            // Check file size
            $upload_max_filesize = get_upload_max_filesize();

            if ( $_FILES['video_upload']['size'] > $upload_max_filesize ) {
                $message['type']    = 'erreur';
                $message['content'] = 'Taille de l\'image trop grande ( > ' . $upload_max_filesize . ').';

                $upload_ok = 0;
            }
            // Allow certain file formats
            $valides_extensions = array( 'mp4', 'webm' );

            if ( !in_array( $video_file_type, $valides_extensions ) ) {
                $message['type']    = 'erreur';
                $message['content'] = 'Uniquement des videos de type MP4, WEBM';

                $upload_ok = 0;
            }
            // Check if $upload_ok is set to 0 by an error
            if ( $upload_ok == 1 ) {
                if ( move_uploaded_file( $_FILES['video_upload']['tmp_name'], $target_file ) ) {
                    $_POST['video'] = $target_file;
                } else {
                    $message['type']    = 'erreur';
                    $message['content'] = 'La vidéo '. basename( $_FILES['video_upload']['name']). ' n\'a été correctement chargée.';
                }
            }
        }

        return $message;
    }

    /**
     *
     * @param string $target
     */
    function upload_file( $target = '' ) {
        $target_dir      = 'public/uploads/';
        if ( $target != '' )  $target_dir .= $target . '/';
        $target_file     = $target_dir . basename( $_FILES['file_upload']['name'] );
        $target_file     = check_file_name( $target_file );

        $message = array(
            'type'    => '',
            'content' => '',
        );

        $upload_ok = 1;
        $file_type = pathinfo( $target_file, PATHINFO_EXTENSION );

        // Check if file already exists
        if ( file_exists( $target_file ) ) {
            $message['type']    = 'alert';
            $message['content'] = 'Une fichier avec le même nom existe déjà sur le serveur et sera utilisé.';

            $_POST['file'] = $target_file;
            $upload_ok = 0;
        } else {
            $upload_max_filesize = get_upload_max_filesize();

            // Check file size
            if ( $_FILES['file_upload']['size'] > $upload_max_filesize ) {
                $message['type']    = 'erreur';
                $message['content'] = 'Taille de l\'image trop grande ( > ' . $upload_max_filesize . ').';

                $upload_ok = 0;
            }
            // Allow certain file formats
            $valides_extensions = array( 'pdf' );

            if ( !in_array( $file_type, $valides_extensions ) ) {
                $message['type']    = 'erreur';
                $message['content'] = 'Uniquement des fichiers de type PDF.';

                $upload_ok = 0;
            }
            // Check if $upload_ok is set to 0 by an error
            if ( $upload_ok == 1 ) {
                if ( move_uploaded_file( $_FILES['file_upload']['tmp_name'], $target_file ) ) {
                    $_POST['file'] = $target_file;
                } else {
                    $message['type']    = 'erreur';
                    $message['content'] = 'Le fichier '. basename( $_FILES['file_upload']['name']). ' n\'a été correctement chargé.';

                }
            }
        }

        return $message;
    }

    /**
     *
     */
    function get_upload_max_filesize() {
        $upload_max_filesize = ini_get('upload_max_filesize');
        $upload_max_filesize = in_bytes( $upload_max_filesize );

        return $upload_max_filesize;
    }

    /**
     *
     * @param string $value
     *
     * @return int $value
     */
    function in_bytes( $value ) {
        $value = trim( $value );
        $last = strtolower( substr( $value, -1 ) );
        $value = intval( substr( $value, 0, -1 ) );

        if ( $last == 'k' ) $value = $value * 1024;

        if ( $last == 'm' ) $value = $value * 1024 * 1024;

        if ( $last == 'g' ) $value = $value * 1024 * 1024 * 1024;

        return $value;


    }

    /**
     *
     * @param int $display
     *
     * @return string/int $menu_order
     */
    function display_menu_order( $menu_order ) {
        if ( $menu_order == 0 )
            return '';
        else
            return $menu_order;

    }

    /**
     *
     * @param int $value
     *
     * @return string
     */
    function display_yes_no( $value ) {
        if ( $value == 0 )
            return '';
        else
            return 'oui';

    }

    /**
     * @param object $link
     *
     * @return string $home_page
     */
    function home_page( $link ) {
        $manager = new SheetManager( $link );
        $sheets = $manager->findAll('menu_order');

        $home_page = 'welcome';

        $i     = 0;
        $count = count( $sheets );
        while ( $i < $count ) {
            $sheet = $sheets[$i];

            if ( $sheet->getMenuOrder() > 0 ) {
                $home_page = 'sheet_id_' . $sheet->getId();

                break;
            }

            $i++;
        }

        return $home_page;
    }

    /**
     * @param string $current_page
     * @param string $page
     * @param boolean $sub_menu
     *
     * @return string
     */
    function menu_selected( $current_page, $page, $sub_menu = false ) {
        if ( isset( $_GET['id'] ) ) $current_page .= '_id_' . $_GET['id'];

        if ( $current_page == $page ) {
            if ( $sub_menu ) return 'header-sub-menu_selected';
            return 'header-menu_selected';
        }
        else
            return '';
    }

    /**
     * @param string/int $count
     *
     * @return string
     */
    function plural( $count ) {
        $count = intval( $count );
        if ( $count > 1 )
            return 's';
        else
            return '';
    }
?>