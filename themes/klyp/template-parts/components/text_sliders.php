<?php 
    //Settings
    $section_show               = get_sub_field('component_text_sliders_component_enabled');
    $section_id                 = get_sub_field('component_text_sliders_field_id');
    $section_class              = get_sub_field('component_text_sliders_field_class');
    
    //Contents
    $slide_background           = get_sub_field('component_text_sliders_background_image');
    
    //Get all slider contents
    $all_slides                 = get_sub_field('component_text_sliders_repeater');
    $slide_content_ouput        = '';
    foreach ($all_slides as $slide) {
        $slide_content_ouput    .= '<div class="section-testimonial__slider-item">' . '
                                        <h2 class="section-testimonial__title text-center">
                                            ' . $slide['title'] . '
                                        </h2> ' .
                                        $slide['feature_description'] . '
                                     </div>';
    }

    //Get all client images and links
    $all_clients                = get_sub_field('component_client_img_repeater');
    $client_content_output      = '';
    foreach ($all_clients as $client) {
        $client_content_output .= '<div class="section-testimonial__client-slider-item">';
        if ($client['client_img']) {
            if ($client['client_url']) {
                $client_content_output .= '<a href="' . $client['client_url']['url'] . '" class="d-block"
                    ' . (($client['client_url']['target']) ? 'target="_blank"' : '') .'>
                    <img src="' . $client['client_img'] . '" class="img-fluid" alt="">
                </a>';
            } else {
                $client_content_output .= '<img src="' . $client['client_img'] . '" class="img-fluid" alt="">';
            }
        }
        $client_content_output .= '</div>';
    }

?>
<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> mn-section mn-testimonial section-testimonial position-relative" style="background-image: url(<?= $slide_background; ?>)">
        <div class="container position-relative section-testimonial__container">
            <div class="row">
                <div class="col-12">
                    <div class="section-testimonial__slider text-center">
                        <?= $slide_content_ouput; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-testimonial__client">
            <div class="section-testimonial__client-slider">
                <?= $client_content_output; ?>
            </div>
        </div>
    </section>
<?php endif; ?>