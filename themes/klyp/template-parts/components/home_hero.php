<?php
$post_type = get_post_type();
//Settings
$section_show               = get_sub_field('component_home_hero_component_enabled');
$section_id                 = get_sub_field('component_home_hero_field_id');
$section_class              = get_sub_field('component_home_hero_field_class');
$section_layout             = get_sub_field('component_home_hero_layout');
$layout_class               = $section_layout == 'four' ? 'lg:grid-cols-4' : '';

//Contents
$title                      = get_sub_field('component_home_hero_heading');
$company_repeater           = get_sub_field('component_home_company_repeater');
$default_background_image   = get_sub_field('component_home_hero_default_image') ? get_sub_field('component_home_hero_default_image') : get_template_directory_uri() . '/assets/dist/img/hero-banner.jpg';
$company_output = '';
$company_bg_output = '';
$banner_img_load_output = '';
$index = 1;

//Generate outputs
foreach ($company_repeater as $company) {

    //Generate GET value to product page - to have the selected categories checkboxes ticked
    if ($company['cta_product_category']) {
        $cta_cat_url = '?';
        $all_selected_cta_cat = array();

        foreach ($company['cta_product_category'] as $cta_cat) {
            //Select child category only
            if ($cta_cat->parent != 0) {
                if (empty($all_selected_cta_cat[$cta_cat->parent])) {
                    $all_selected_cta_cat[$cta_cat->parent] = $cta_cat->term_id;
                } else {
                    $all_selected_cta_cat[$cta_cat->parent] .= ',' . $cta_cat->term_id;
                }
            }
        }

        //Add parent slug and child category ID as additional URL string
        $last_element = array_key_last($all_selected_cta_cat);
        foreach ($all_selected_cta_cat as $parent_id => $all_child_cat_id) {
            $cta_cat_url .= get_term($parent_id,'product_cat')->slug . '=' . $all_child_cat_id;
            if ($parent_id != $last_element) {
                $cta_cat_url .= '&';
            }
        }
    } else {
        $cta_cat_url = '';
    }

    $banner_img_load_output .= '<img src="' . $company_bg . '" alt="">';
    $company_output .= '<div class="" data-content="' . $index . '">
                            <div class="flex flex-col gap-4">
                                <div class="h-24">
                                    <img src="' . $company['company_logo'] . '" alt="" class="w-auto h-full object-contain">
                                </div>';
                                if ($company['company_name']) {
                                $company_output .= '<div class="flex flex-col gap-2">
                                    <h3 class="text-lg">' . $company['company_name'] . '</h3>
                                    <div class="">' . $company['company_subtitle'] . '</div>
                                </div>';
                                }
            $company_output .=  '<div class="">
                                    <p>' . $company['company_description'] . '</p>';
                                    if ($company['enable_cta'] == true) {
                                            $company_output .= '<div class="flex">
                                            <a class="flex self-start items-center gap-2" href="' . $company['cta_url'] . $cta_cat_url . '">Learn More <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" /></svg></a></div>';
                                        }
            $company_output .=     '</div>
                            </div>
                        </div>';
    $index++;
}
?>
<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
            <?php if($title): ?>
                <div class="flex flex-col-reverse lg:flex-row gap-4 items-center">
                    <h2 class="text-3xl lg:text-4xl font-light lg:max-w-screen-sm">
                        <?= $title; ?>
                    </h2>
                </div>
                <hr class="border-t w-full my-12 border-black">
            <?php endif; ?>
            <div class="grid grid-cols-2 items-center lg:grid-cols-3 <?= $layout_class; ?> gap-6 sm:gap-12">
                <?= $company_output; ?>
            </div>
        </div>
    </section>
<?php endif; ?>