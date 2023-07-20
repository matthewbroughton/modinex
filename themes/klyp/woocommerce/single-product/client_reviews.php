<?php
    //Settings
    $section_show     = get_field('product_details_client_reviews')['enable_mobile'];
    $section_id       = get_field('product_details_client_reviews')['id'] ? get_field('product_details_client_reviews')['id'] : 'client-reviews';
    $section_class    = get_field('product_details_client_reviews')['class'];
    
    //Contents
    $review_html      = '';
    $reviews          = get_field('product_details_client_reviews')['pd_client_reviews_list'] != false ? get_field('product_details_client_reviews')['pd_client_reviews_list'] : get_field('pd_general_client_reviews_list','option');
?>

<?php if ($section_show == true) :
    foreach ($reviews as $review) {
        $review_html .= '<div class="section-review__slider">
                            <div class="section-review__slide">
                                <img src="' . $review['pd_reviewer_logo'] . '" alt=""
                                    class="section-review__slide-img imf-fluid">
                                <div class="section-review__slide-content">
                                    <p class="m-0">
                                        ' . $review['pd_review'] . '
                                    </p>
                                </div>
                            </div>
                        </div>';
    }
?>
    <section class="mn-section section-review <?= $section_class; ?>" id="<?= $section_id; ?>">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-review__slider-wrap">
                        <?= $review_html; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
