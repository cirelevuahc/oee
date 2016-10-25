<?php
    $i = 0;
    $count = count( $statuss );
    while ( $i < $count ) {
        $status = $statuss[$i];

        if ( $user_action == 'modify' )
            $current_status = $user->getStatus();
        else
            $current_status = 0;

        require('views/admin/user-edit-status.phtml');

        $i++;
    }

?>