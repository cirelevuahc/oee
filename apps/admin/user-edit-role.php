<?php
    $i = 0;
    $count = count( $roles );
    while ( $i < $count ) {
        $role = $roles[$i];

        if ( $user_action == 'modify' )
            $current_role_id = $user->getRole()->getId();
        else
            $current_role_id = 4;

        require('views/admin/user-edit-role.phtml');

        $i++;
    }

?>