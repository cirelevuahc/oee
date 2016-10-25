<?php
    $sheet_manager = new SheetManager( $link );
    $sheets = $sheet_manager->findAll();

    require('views/admin/newsletter-edit-sheets.phtml');
?>