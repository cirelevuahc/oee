<?php
    if (
        $_SESSION['user']['capability']['admin'] == 1
    ) {
        require('views/admin/header-menu-admin.phtml');
    } else {
        if (
            $_SESSION['user']['capability']['editor'] == 1 ||
            $_SESSION['user']['capability']['author'] == 1
        ) {
            require('views/admin/header-menu-editor-author.phtml');
        }
    }

?>