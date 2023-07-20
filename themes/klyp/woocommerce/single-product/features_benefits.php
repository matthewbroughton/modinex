<?php
    //Settings
    $section_show           = get_field('product_details_features_benefits')['enable_mobile'];
    $section_id             = get_field('product_details_features_benefits')['id'] ? get_field('product_details_features_benefits')['id'] : 'feature-benefit';
    $section_class          = get_field('product_details_features_benefits')['class'];

    //Contents
    $feature_title          = get_field('product_details_features_benefits')['fnb_title'];
    $feature_description    = get_field('product_details_features_benefits')['fnb_description'];

    $fnb_icons_html         = '';
    $fnb_icons              = get_field('product_details_features_benefits')['fnb_icon_repeater'];

    $fnb_benefits_html1     = '';
    $fnb_benefits_html2     = '';
?>

<?php if ($section_show == true) :
    foreach ($fnb_icons as $fnb_icon) {
        $fnb_icons_html .= '<div class="flex flex-col gap-4">
                                <img src="' . $fnb_icon['fnb_icon'] . '" alt=""
                                    class="section-featured__feature-icon w-12 h-12">
                                <div class="section-featured__feature-wrap">
                                    <h4 class="text-xl mb-2">
                                        ' . $fnb_icon['fnb_icon_description'] . '
                                    </h4>
                                    <div class="text-gray-600">'
                                        . $fnb_icon['fnb_body_text'] .
                                    '</div>
                                </div>
                            </div>';
    }

    $fnb_index = 1;
?>
<section class="bg-white border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36 <?= $section_class; ?>" id="<?= $section_id; ?>">
    <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
        <div class="grid lg:grid-cols-12 divide-y lg:divide-y-0 lg:divide-x divide-black gap-8 lg:gap-12">
            <div class="lg:col-span-4">
                <h2 class="text-3xl lg:text-4xl font-light lg:max-w-screen-sm">
                    Features and Benefits
                </h2>
                <div class="text-lg text-gray-600 max-w-md">
                    <?= $feature_description; ?>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-12 pt-8 lg:pt-0 lg:pl-12 lg:col-span-8">
                <?= $fnb_icons_html; ?>
            </div>
        </div>
    </div>
</section>
    <?php
        array_push($has_section, $section_id . '/Features & Benefits');
    ?>
<?php endif; ?>
