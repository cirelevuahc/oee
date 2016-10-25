<?php
    $svg_icon = new SvgIcon();
    $small_menu_icon = $svg_icon->display( IMAGE_PATH . '/icons/ec-icon-hamburger-multiply.svg', 'small-menu-icon','small-menu-icon', false, false );

    require('views/small-menu.phtml');
?>