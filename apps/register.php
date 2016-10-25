<?php
    $name              = '';
    $forname           = '';
    $email             = '';
    $login             = '';
    $password          = '';
    $confirme_password = '';
    $pseudo            = '';

    if ( isset( $_POST['name'] ) ) $name                            = $_POST['name'];
    if ( isset( $_POST['forname'] ) ) $forname                      = $_POST['forname'];
    if ( isset( $_POST['email'] ) ) $email                          = $_POST['email'];
    if ( isset( $_POST['login'] ) ) $login                          = $_POST['login'];
    if ( isset( $_POST['password'] ) ) $password                    = $_POST['password'];
    if ( isset( $_POST['confirme_password'] ) ) $confirme_password  = $_POST['confirme_password'];
    if ( isset( $_POST['pseudo'] ) ) $pseudo                        = $_POST['pseudo'];

    require('views/register.phtml');
?>