<?php
    $i = 0;
    $count = count( $settings );
    while ( $i < $count ) {
        $setting = $settings[$i];

        require('views/admin/setting.phtml');

        $i++;
    }


?>