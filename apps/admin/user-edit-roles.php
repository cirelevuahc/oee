<?php
    $role_manager = new RoleManager( $link );
    $roles = $role_manager->findAll();

    require('views/admin/user-edit-roles.phtml');
?>