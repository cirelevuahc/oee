<?php

    if ( $sheet->getNewsletter() == 0 ) return;
    
    $manager    = new NewsletterManager( $link );
    $newsletters   = $manager->findBySheet( $sheet );
    require('views/newsletters.phtml');

?>