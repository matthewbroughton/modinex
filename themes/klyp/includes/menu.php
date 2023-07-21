<?php
/**
 * Menu Function and Template
 */

/**
 * Get nav menu items by name
 * @param string
 * @param array
 * @return string
 */
function klyp_get_nav_menu_items_by_name($name, $args = [])
{
    // Get object id by name
    $object = wp_get_nav_menu_object($name);

    // Get menu items by menu name
    $menuItems = wp_get_nav_menu_items($object->name, $args);

    // Return menu post objects
    return $menuItems;
}

/**
 * Generate header vertical menu
 *
 * @param $name
 * @return menu output
 */
function klyp_generate_header_vertical_menu($name)
{
    $menuItems = klyp_get_nav_menu_items_by_name($name);
    if (empty($menuItems)) {
        return;
    }
    $menuItemsList = array();
    $menuTree = array();
    foreach ($menuItems as $menuItem) {
        $menuItemsList[$menuItem->ID] = $menuItem;
        $menuTree[$menuItem->menu_item_parent][$menuItem->menu_order] = $menuItem->ID;
    }

    // loop all first level menus
    $menuOutput = '';
    $index = 0;
    foreach ($menuTree[0] as $menuItemId) {
        // get current menu item
        $first_show = $index == 0 ? 'active' : '';
        $thisMenuItem = $menuItemsList[$menuItemId];
        $menuOutput .= '<li class="nav-item ' . implode(' ', $thisMenuItem->classes) . '" id="heading-' . $thisMenuItem->post_name . '"><a href="' . $thisMenuItem->url . '" class="nav-link ' . $first_show . '">' . $thisMenuItem->title . '</a></li>';
        $index++;
    }
    return $menuOutput;
}

/**
 * Generate header right top level menu
 *
 * @param $name
 * @return menu output
 */
function klyp_generate_header_top_level_menu_items($name)
{
    $menuItems = klyp_get_nav_menu_items_by_name($name);
    if (empty($menuItems)) {
        return;
    }
    $menuItemsList = array();
    $menuTree = array();
    foreach ($menuItems as $menuItem) {
        $menuItemsList[$menuItem->ID] = $menuItem;
        $menuTree[$menuItem->menu_item_parent][$menuItem->menu_order] = $menuItem->ID;
    }

    // loop all first level menus
    $menuOutput = '';
    $index = 0;
    foreach ($menuTree[0] as $menuItemId) {
        // get current menu item
        $first_show = $index == 0 ? 'active' : '';
        $thisMenuItem = $menuItemsList[$menuItemId];
        $menuOutput .= '<li class="nav-item ' . implode(' ', $thisMenuItem->classes) . '" id="heading-' . $thisMenuItem->post_name . '"><a href="#' . $thisMenuItem->post_name . '" class="nav-link ' . $first_show . '" data-toggle="tab">' . $thisMenuItem->title . '</a></li>';
        $index++;
    }
    return $menuOutput;
}

/**
 * Generate header right sub level menu
 *
 * @param $name
 * @return menu output
 */
function klyp_generate_header_second_level_menus($name)
{
    $menuItems = klyp_get_nav_menu_items_by_name($name);
    if (empty($menuItems)) {
        return;
    }
    $menuItemsList = array();
    $menuTree = array();
    foreach ($menuItems as $menuItem) {
        $menuItemsList[$menuItem->ID] = $menuItem;
        $menuTree[$menuItem->menu_item_parent][$menuItem->menu_order] = $menuItem->ID;
    }
    // loop all first level menus
    $menuOutput = '';
    $index = 0;
    foreach ($menuTree[0] as $menuItemId) {
        // get current menu item
        $thisMenuItem = $menuItemsList[$menuItemId];
        $first_show = $index == 0 ? 'active show' : '';

        //Sub Menu
        if (! empty($menuTree[$menuItemId])) {
            $menuOutput .= '<div id="' . $thisMenuItem->post_name . '" class="tab-pane sub_menu_container fade ' . $first_show . '">
                                <div class="row">';

                foreach ($menuTree[$menuItemId] as $secondLevelMenuId) {
                    $menuOutput .= '<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                        <div class="mn-header__sub-menu-product position-relative ' . implode(' ', $thisMenuItem->classes) . '">
                                            <a href="' . get_category_link($menuItemsList[$secondLevelMenuId]->object_id) . '" class="mn-header__sub-menu-product-link" data-parent-cat="' . $thisMenuItem->post_name . '" data-step="' . $index . '">
                                                <div class="mn-header__sub-menu-product-img">
                                                    <img src="' . get_field('sbc_menu_item_image', $secondLevelMenuId) . '" class="img-fluid" alt="">
                                                </div>
                                                <div class="mn-header__sub-menu-product-title">
                                                    <h3>' . $menuItemsList[$secondLevelMenuId]->title . '</h3>
                                                </div>
                                            </a>
                                        </div>
                                    </div>';
                }

            $menuOutput .= '    </div>
                            </div>';
        }
        $index++;
    }
    return $menuOutput;
}

function klyp_generate_mega_menu($name)
{
    ob_start();

    // Get the menu items by name
    $menuItems = klyp_get_nav_menu_items_by_name($name);
    if (empty($menuItems)) {
        return;
    }

    $menuItemsList = array();
    $menuTree = array();
    foreach ($menuItems as $menuItem) {
        $menuItemsList[$menuItem->ID] = $menuItem;
        $menuTree[$menuItem->menu_item_parent][$menuItem->menu_order] = $menuItem->ID;
    }

    // Loop through the menu items
    foreach ($menuItems as $menuItem) {
        // Check if the current item is a top-level menu item
        if ($menuItem->menu_item_parent == 0) {
            echo '<div class="flex items-center gap-x-2 lg:justify-center whitespace-nowrap group hover:bg-sage/20 px-4 py-2">';
            echo '<a class="tracking-wide" href="' . $menuItem->url . '">' . $menuItem->title . '</a>';

            // Check if the top-level menu item has submenu items
            if (!empty($menuTree[$menuItem->ID])) {
                echo '<svg class="h-5 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                  </svg>';
                echo '<div class="absolute inset-x-0 top-[calc(100%+1px)] -z-10 bg-white opacity-0 transform transition duration-200 -translate-y-full group-hover:opacity-100 group-hover:translate-y-0 border-b border-black">';
                    echo '<div class="mx-auto max-w-7xl">';
                        echo '<div class="lg:-ml-12 grid grid-cols-1 gap-x-8 lg:gap-x-12 gap-y-10 px-6 py-10 lg:grid-cols-4 lg:divide-x lg:divide-black">';
                        foreach ($menuTree[$menuItem->ID] as $subMenuItemId) {
                            $subMenuItem = $menuItemsList[$subMenuItemId];
                            echo '<div class="mega-menu-column lg:pl-12">';
                            echo '<ul>';
                            echo '<li>';
                            echo '<a class="tracking-wide font-light flex flex-col hover:bg-sage/20" href="' . $subMenuItem->url . '">';
                                if (get_field('sbc_menu_item_image', $subMenuItemId)) {
                                    echo '<div class="aspect-w-16 aspect-h-10">';
                                    echo '<img src="' . get_field('sbc_menu_item_image', $subMenuItemId) . '" class="w-full h-full object-cover" alt="">';
                                    echo '</div>';
                                }
                            echo '<span class="p-4">' . $subMenuItem->title . '</span>';
                            echo '</a>';
                            echo '</li>';

                            // Check if the second-level menu item has tertiary items
                            if (!empty($menuTree[$subMenuItemId])) {
                                // Store the tertiary menu items in the array
                                $tertiaryMenuItems[$subMenuItemId] = $menuTree[$subMenuItemId];

                                echo '<ul class="divide-y divide-sage/30">';

                                    // output tertiary list for this second level element here.
                                    foreach ($menuTree[$subMenuItemId] as $tertiaryMenuItemId) {
                                        $tertiaryMenuItem = $menuItemsList[$tertiaryMenuItemId];
                                        echo '<li><a class="py-2 px-4 flex hover:bg-sage/20 whitespace-normal" href="' . $tertiaryMenuItem->url . '">' . $tertiaryMenuItem->title . '</a></li>';
                                    }

                                echo '</ul>';

                            }

                            echo '</ul>';
                            echo '</div>';
                        }

                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }

            echo '</div>';
        }
    }



    $output = ob_get_clean();
    return $output;
}

function klyp_generate_mobile_menu($name)
{
    ob_start();

    // Get the menu items by name
    $menuItems = klyp_get_nav_menu_items_by_name($name);
    if (empty($menuItems)) {
        return;
    }

    $menuItemsList = array();
    $menuTree = array();
    foreach ($menuItems as $menuItem) {
        $menuItemsList[$menuItem->ID] = $menuItem;
        $menuTree[$menuItem->menu_item_parent][$menuItem->menu_order] = $menuItem->ID;
    }

    // Loop through the menu items
    foreach ($menuItems as $menuItem) {
        // Check if the current item is a top-level menu item
        if ($menuItem->menu_item_parent == 0) {
            echo '<div class="-mx-3">';
                echo '<div class="flex w-full items-center justify-between py-2 pl-3 pr-3.5">';
                    echo '<a class="flex-shrink-0" href="' . $menuItem->url . '">' . $menuItem->title . '</a>';
                    if (!empty($menuTree[$menuItem->ID])) {
                        echo '<button type="button" id="button-'. $menuItem->ID . '" class="toggleSubMenu p-4 flex justify-end tracking-wide" aria-controls="disclosure-'. $menuItem->ID . '" aria-expanded="false"><svg class="h-5 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                          </svg></button>';
                    }
                echo '</div>';

            // Check if the top-level menu item has submenu items
            if (!empty($menuTree[$menuItem->ID])) {
                    echo '<div class="mt-2 space-y-2" id="disclosure-'. $menuItem->ID .'" role="region" aria-labelledby="button-'. $menuItem->ID . '" hidden>';
                    foreach ($menuTree[$menuItem->ID] as $subMenuItemId) {
                        $subMenuItem = $menuItemsList[$subMenuItemId];
                        echo '<a class="block py-2 pl-6 pr-3" href="' . $subMenuItem->url . '">'. $subMenuItem->title . '</a>';
                    }
                    echo '</div>';
            }
            echo '</div>';

        }
    }



    $output = ob_get_clean();
    return $output;
}

?>