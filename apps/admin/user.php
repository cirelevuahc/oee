<?php
    $status = new StatusManager();
    $status->findByStatus(1);
    
    $i      = 0;
    $count  = count( $users );
    while ( $i < $count ) {
        $user = $users[$i];

        require('views/admin/user.phtml');

        $i++;
    }
?>