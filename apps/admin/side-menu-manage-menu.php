<?php
    if (
        $_SESSION['user']['capability']['admin'] == 1 ||
        $_SESSION['user']['capability']['editor'] == 1
    )
        require('views/admin/side-menu-manage-menu.phtml');
?>