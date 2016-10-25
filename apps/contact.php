<?php
    $contact_name    = '';
    $contact_forname = '';
    $contact_email   = '';
    $contact_message = '';

    if ( isset( $_POST['contact_name'] ) ) $contact_name        = $_POST['contact_name'];
    if ( isset( $_POST['contact_forname'] ) ) $contact_forname  = $_POST['contact_forname'];
    if ( isset( $_POST['contact_email'] ) ) $contact_email      = $_POST['contact_email'];
    if ( isset( $_POST['contact_message'] ) ) $contact_message  = $_POST['contact_message'];

    require('views/contact.phtml');

?>