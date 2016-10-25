<?php
    if ( isset( $_GET['id'] ) ) {
        $id_sheet = intval( $_GET['id'] );
        $manager     = new SheetManager( $link );
        $sheet    = $manager->findById( $id_sheet );

        if ( $sheet == null ) {
            $sheet  = $manager->findFirst();
        }

        require('views/sheet.phtml');
    }

?>