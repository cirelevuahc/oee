<?php
    if (
        $_SESSION['user']['capability']['admin'] == 1 
    )
        require('views/admin/side-menu-setting.phtml');
?>