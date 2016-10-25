<?php
    $sheet_manager = new SheetManager( $link );
    $sheets = $sheet_manager->findAll();

    require('views/admin/article-edit-sheets.phtml');
?>