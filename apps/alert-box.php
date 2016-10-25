<?php
    if ( !empty( $message['content'] ) ) {

        $alert_title = ucfirst( $message['type'] );
        $alert_msg   = $message['content'];

        require('views/alert-box.phtml');
    }

?>