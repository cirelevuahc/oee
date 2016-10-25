<?php
    $status_manager = new StatusManager();
    $statuss = $status_manager->findAll();

    require('views/admin/user-edit-statuss.phtml');
?>