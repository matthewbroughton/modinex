<?php
/**
 * Ajax function, to return search result on request
 * @return void
 */
function live_search()
{
    // Get search term from search field
    $search = sanitize_text_field($_POST['query']);

    $searchType = get_field('post_type_in_search', 'option');
    // Set up query using search string, limit to 8 results
    $query = new WP_Query(
        array(
            'posts_per_page' => 15,
            's' => $search,
            'post_type' => $searchType,
            'post_status' => 'publish',
        )
    );

    $page_output = '';
    $search_output = '';
    // Run search query
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_type = get_post_type(get_the_ID());

            if (! empty($searchType)) {
                if (in_array($post_type, $searchType)) {
                    if ($post_type == 'page' || $post_type == 'post') {
                        $page_output .= '<p><a href="' . get_permalink() . '">' . get_the_title() . '</a><br/></p>';
                    } else {
                        $search_output .= '<div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                                <div class="section-product-list__list-wrap">
                                                    <a href="' . get_permalink() . '">
                                                        <div class="section-product-list__img aspect-h-1 aspect-w-1 mb-2">
                                                            <img src="' . get_the_post_thumbnail_url(get_the_ID()) . '" alt="" class="h-full w-full object-cover">
                                                        </div>
                                                        <div class="section-product-list__title">
                                                            <h3 class="capitalize">' . mb_strtolower(get_the_title()) . '</h3>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>';
                    }
                }
            }
        }

        $page_output = $page_output != '' ? $page_output : '<p class="no_result_text">No results</p>';
        $search_output = $search_output != '' ? $search_output : '<p class="no_result_text">No results</p>';
        echo '<div class="grid grid-cols-1 lg:grid-cols-12 lg:divide-x lg:divide-black">
                  <div class="order-last lg:order-none lg:col-span-3 p-4 mns__page_post">
                      <h4 class="text-xl mb-4">Articles</h4>
                      <div class="results__returned">
                      ' . $page_output . '
                      </div>
                  </div>
                  <div class="order-first lg:order-none lg:col-span-9 p-4 mns__search_results">
                      <h4 class="text-xl mb-4">Search Results</h4>
                      <div class="results__returned">
                          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                          ' . $search_output . '
                          </div>
                      </div>
                  </div>
              </div>';
    } else {
        // There are no results, output a message
        echo '<p class="no-results">No results</p>';
    }

    // Reset query
    wp_reset_query();
    wp_die();
}
add_action('wp_ajax_live_search' , 'live_search');
add_action('wp_ajax_nopriv_live_search','live_search');
?>