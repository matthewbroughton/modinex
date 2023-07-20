<?php

/**
 * Ajax function, to return more products from the current query
 * return string
 */
function product_list_refresh()
{
    if (sanitize_text_field($_POST['page'])) {
        $paged = sanitize_text_field($_POST['page']);
    } else {
        $paged = 1;
    }

    $post_per_page = get_field('products_per_page', 'option');

    $product_option_list = explode(',', sanitize_text_field($_POST['product_option']));

    if (sanitize_text_field($_POST['product_option']) != '') {
        if (count($product_option_list) > 1) {
            $tax_query_args = array(
                array(
                    'taxonomy'      => 'product_cat',
                    'field'         => 'term_id',
                    'terms'         => $product_option_list,
                    'operator'      => 'AND',
                ),
            );
        } else {
            $tax_query_args = array(
                array(
                    'taxonomy'      => 'product_cat',
                    'field'         => 'term_id',
                    'terms'         => $product_option_list,
                    'operator'      => 'IN',
                ),
            );
        }
        $args = array(
            'posts_per_page'        => $post_per_page,
            'paged'                 => $paged,
            'post_type'             => 'product',
            'tax_query'             => $tax_query_args,
            'orderby'               => 'title',
            'order'                 => 'asc',
        );
    } else {
        $args = array(
            'posts_per_page' => $post_per_page,
            'paged'          => $paged,
            'post_type'      => 'product',
            'orderby'        => 'post_date',
            'order'          => 'desc',
        );
    }

    $product_query = new WP_Query($args);
    $maxPageNumber = $product_query->max_num_pages;
    $i = 0;
    while ($product_query->have_posts()) { 
        $product_query->the_post();
        $product_title     = get_the_title();
        $product_link      = get_permalink(get_the_ID());
        $product_image_url = get_the_post_thumbnail_url(get_the_ID());
        global $product;
        $attachment_ids =   $product->get_gallery_image_ids();
        $image_link = wp_get_attachment_url($attachment_ids[0],'full');
        require(get_template_directory() . '/template-parts/components/product_archive_template.php');
        $i++;
    }
    wp_die();
}
add_action('wp_ajax_nopriv_product_list_refresh', 'product_list_refresh');
add_action('wp_ajax_product_list_refresh', 'product_list_refresh');

/**
 * Ajax function, to return more products from the current query
 * return string
 */
function product_variation_image_upload()
{
    // Validate the nonce
    if (! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'klyp_generate_nonce')) {
        exit;
    }

    $nextType = isset($_POST['nextType']) ? sanitize_text_field($_POST['nextType']) : '';
    $opKey    = isset($_POST['opKey']) ? sanitize_text_field($_POST['opKey']) : '';
    $postId   = isset($_POST['postId']) ? sanitize_text_field($_POST['postId']) : '';
    $options  = isset($_POST['options']) ? $_POST['options'] : '';

    $productOptionsFields = get_field('product_option_repeater', $postId);
    $image = '';
    $nextValues = array();
    $productDepValue = array();
    if (! empty($productOptionsFields) && is_array($productOptionsFields)) {
        $productDepValue = get_the_product_dependency_options($productOptionsFields, $postId);
        $matches = array();
        $nextMatch = array();
        if (! empty($productDepValue) && is_array($productDepValue)) {
            $count = 0;
            foreach ($options as $oKey => $oVal) {
                if ($oVal != '') {
                    foreach ($productDepValue as $pdKey => $pdVal) {
                        if ($pdVal[$oKey] == $oVal) {        
                            //If the dependency value matches the selected option, add the array index of this dependency array to match list
                            $matches[$count][] = $pdKey;
                        } else {
                            //Otherwise, remove this dependency array out of the list if not matches
                            unset($productDepValue[$pdKey]);
                        }
                    }
                    $count ++;
                }
            }
            $match = array_filter(array_values(call_user_func_array('array_intersect', $matches)));
            if (! empty($nextType)) {
                if (! empty($matches)) {
                    foreach ($matches as $mKey => $mVal) {
                        if ($mKey == $opKey) {
                            $nextMatch[$mKey] = $mVal;
                        }
                    }
                }
                $nMatch = $nextMatch[$opKey];
                if (! empty($nMatch)) {
                    foreach ($productDepValue as $pKey => $pVal) {
                        foreach ($nMatch as $nKey => $nVal) {
                            if (! is_null($nVal)) {
                                if ($pKey == $nVal) {
                                    if (! in_array($productDepValue[$pKey][$nextType], $nextValues)) {
                                        $nextValues[$nKey] = $productDepValue[$pKey][$nextType];
                                    }
                                }
                            } else {
                                $nextValues[$nKey] = null;
                            }
                        }
                    }
                }
            } else {
                //If the selected dependency has image, show it
                if (! empty($match)) {
                    if ($productDepValue[$match[0]]['image'] != '') {
                        $image = $productDepValue[$match[0]]['image'];
                    } else {
                        //Otherwise, show the default product image
                        $image = $image = wp_get_attachment_image_url(wc_get_product($postId)->get_image_id(), 'full');
                    }
                } else {
                    //If nothing matches and the size of dependency option is 1, which mean it has only 1 option and no dependency
                    if (sizeof($productDepValue) == 1) {
                        $image = $productDepValue[0]['image'];
                    }
                }
            }
        } else {
            //Only one option and no product dependency
            $image = wp_get_attachment_image_url(wc_get_product($postId)->get_image_id(), 'full');
        }
    }

    echo json_encode(array('image' => $image, 'nextValues' => $nextValues));
    wp_die();
}
add_action('wp_ajax_nopriv_product_variation_image_upload', 'product_variation_image_upload');
add_action('wp_ajax_product_variation_image_upload', 'product_variation_image_upload');
?>