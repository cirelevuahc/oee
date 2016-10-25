<?php
    if ( $user_action == 'new' ) require('views/admin/user-edit-password.phtml');
    if ( $user_action == 'modify' ) require('views/admin/user-edit-password-modify.phtml');
?>