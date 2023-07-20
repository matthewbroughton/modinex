<?php
$state_list = array('QLD', 'NSW', 'VIC', 'SA', 'ACT', 'NT', 'TA', 'WA');
$filter_html = '';

$marker_index = 0;
foreach ($state_list as $state) {
    $store_index = 1;
    $filter_html .= '<div class="section-reseller-map__sidebar-acc">
                         <a href="#' . strtolower($state) . '" class="text-uppercase collapsed d-block section-reseller-map__sidebar-toggle section-reseller-map__sidebar-title position-relative" data-toggle="collapse" aria-expanded="false" aria-controls="filter-type">' . $state . '</a>
                         <div class="collapse multi-collapse section-reseller-map__sidebar-acc-content" id="' . strtolower($state) . '">';
    wp_reset_query();
    $location_query = new WP_Query(array(
        'numberposts'   => 1,
        'post_type'     => 'reseller_location',
        'meta_key'      => 'reseller_location_state',
        'meta_value'    => $state,
    ));

    if ($location_query->have_posts()) {
        while ($location_query->have_posts()) {
            $location_query->the_post();
            $store_title    = get_the_title();
            $store_category = get_the_terms(get_the_ID(), 'reseller_location_category');

            $store_address  = get_field('reseller_location_address', get_the_ID()) . ', ' .
                get_field('reseller_location_city', get_the_ID()) . ' ' .
                get_field('reseller_location_state', get_the_ID()) . ' ' .
                get_field('reseller_location_zip_code', get_the_ID());

            $store_phone    = get_field('reseller_location_phone', get_the_ID());
            $store_lat      = get_field('reseller_location_latitude', get_the_ID());
            $store_lng      = get_field('reseller_location_longtitude', get_the_ID());

            $filter_html    .= '<div class="section-reseller-map__sidebar-acc-box" data-mclick="' . $marker_index . '" data-distance="" data-lat="' . $store_lat . '" data-lng="' . $store_lng . '" data-address="' . $store_address . '">
                                    <span class="section-reseller-map__sidebar-acc-counter">' . $store_index . '</span>
                                    <h3 class="section-reseller-map__sidebar-acc-category">
                                    ' . $store_category[0]->name . '
                                    </h3>
                                    <h2 class="section-reseller-map__sidebar-acc-title">
                                    ' . $store_title . '
                                    </h2>
                                    <div class="section-reseller-map__sidebar-acc-phone">
                                        <img src="' . get_template_directory_uri() . '/assets/dist/img/phone.png" alt="">
                                        <a href="tel:' . $store_phone . '">' . $store_phone . '</a>
                                    </div>
                                </div>';
            $store_index++;
            $marker_index++;
        }
    } else {
        $filter_html .= 'There is no store available';
    }
    $filter_html .= '</div></div>';
}
?>
<section class="mn-section section-reseller-map">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3 section-reseller-map__sidebar">
                <div class="section-reseller-map__sidebar-content">
                    <?= $filter_html; ?>
                </div>
            </div>
            <div class="col-12 col-lg-9 section-reseller-map__map-wrap">
                <select id="section-reseller-map__dropdown" class="section-reseller-map__dropdown">
                    <option value="reseller">All Resellers</option>
                    <option value="showroom">All Show room</option>
                </select>
                <input id="section-reseller-map__input" class="controls section-reseller-map__input" type="text" placeholder="Enter Postcode or Address">
                <div id="reseller-map" class="section-reseller-map__map"></div>
            </div>
        </div>
    </div>
</section>