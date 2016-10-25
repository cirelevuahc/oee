<?php

if ( isset( $_POST['action'] ) ) {

    if ( $_POST['action'] == 'modify' ) {

         try {

            $manager = new SettingManager( $link );
            $options = $_POST['options'];

            $i        = 0;
            $count    = count( $options );
            while( $i < $count ) {
                $option = $options[$i];

                $id = $option['id'];
                $setting = $manager->findById( $id );

                $setting->setValue( $option['value'] );

                $setting = $manager->update( $setting );

                $i++;
            }

            header('Location: settings');
            exit;
         }

         catch (Exception $exception) {
             $message['type']    = 'erreur';
             $message['content'] =  $exception->getMessage();
         }

    }


}

?>