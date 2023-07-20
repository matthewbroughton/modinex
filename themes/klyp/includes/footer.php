<?php
/**
* Register multiple widgets to footer
*
*/
register_sidebar(array(
    'name'                  => 'Footer - Menu Selection',
    'id'                    => 'footer-menu-selection',
    'description'           => 'Select menus that appears in the footer area',
    'before_widget'         => '<div class="pt-4 sm:pt-0 sm:pl-12 first:pl-0">',
    'after_widget'          => '</div>',
    'before_title'          => '<h4 class="font-bold mb-4">',
    'after_title'           => '</h4>',
));
register_sidebar(array(
    'name'                  => 'Footer - Copyright Section Menu Selection',
    'id'                    => 'footer-copyright-menu-selection',
    'description'           => 'Select menus that appears in the Copyright area',
    'before_widget'         => '<div class="footer__link d-inline-block">',
    'after_widget'          => '</div>',
    'before_title'          => '<h4 class="font-bold mb-4">',
    'after_title'           => '</h4>',
));
?>