<?php
    $sub_menu_icon_count++;
    $svg_icon = new SvgIcon();
    $sub_menu_icon = $svg_icon->display( IMAGE_PATH . '/icons/ec-icon-right-down-triangle.svg', 'sub-menu-icon', 'sub-menu-icon',$sub_menu_icon_count , false );
    require('views/sub-menu-icon.phtml');
?>