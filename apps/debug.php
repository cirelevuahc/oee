<?php
    ini_set( 'log_errors', true );
    ini_set( 'error_log', dirname(__FILE__)  . '/../debug.log' );

    function debug( $message, $label = '' ) {
        if ( DEBUG === true)  {
            if ( is_array( $message ) || is_object( $message ) ) {
                error_log( $label . ' ' . print_r( $message, true ) );
            } else {
                error_log( $label . ' ' . $message );
            }
        }
    }

?>