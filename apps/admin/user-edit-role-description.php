<?php
    $i = 0;
    $count = count( $roles );
    while ( $i < $count ) {
        $role = $roles[$i];

        require('views/admin/user-edit-role-description.phtml');

        $i++;
    }

?>