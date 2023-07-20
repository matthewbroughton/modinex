<?php
//Settings
$section_show           = get_field('product_details_how_it_works')['enable_mobile'];
$section_id             = get_field('product_details_how_it_works')['id'] ? get_field('product_details_how_it_works')['id'] : 'how-it-works';
$section_class          = get_field('product_details_how_it_works')['class'];
$section_layout         = get_field('product_details_how_it_works')['fh_layout_type'];
$layout_class           = $section_layout == 'left' ? 'sm:order-last' : '';
$divide_reverse         = $section_layout == 'left' ? 'sm:divide-x-reverse' : '';

//Contents
$feature_title          = get_field('product_details_how_it_works')['title'];
$feature_image_url      = get_field('product_details_how_it_works')['feature_image'];
$feature_video_enabled  = get_field('product_details_how_it_works')['enable_video'];
$feature_video_url      = get_field('product_details_how_it_works')['video_url'];
$feature_layout_type    = get_field('product_details_how_it_works')[''];
$feature_description    = get_field('product_details_how_it_works')['feature_description'];
$feature_cta_enabled    = get_field('product_details_how_it_works')['enable_cta'];
$feature_cta_url_1      = get_field('product_details_how_it_works')['cta_url_1'];
$feature_cta_url_2      = get_field('product_details_how_it_works')['cta_url_2'];
?>
<?php if ($section_show == true) : ?>
    <section class="bg-white border-x border-black mx-4 sm:mx-6 <?= $layout_class; ?> <?= $section_class; ?>" id="<?= $section_id; ?>">
    <div class="grid grid-cols-1 sm:grid-cols-2 divide-black divide-y sm:divide-y-0 sm:divide-x <?= $divide_reverse; ?>">
        <div class="<?= $layout_class; ?>">
            <?php if ($feature_video_enabled === true) : ?>
                <div class="embed-container">
                    <?= $feature_video_url ?>
                </div>
            <?php else: ?>
                <img src="<?= $feature_image_url; ?>" alt="" class="h-full object-cover w-full">
            <?php endif; ?>
        </div>
        <div class="px-6 py-8 md:py-24 md:px-24 flex items-center">
            <div class="flex flex-col">
                <h2 class="mb-4 text-3xl">
                    <?= $feature_title; ?>
                </h2>
                <div>
                    <?= $feature_description; ?>
                </div>
                <?php if ($feature_cta_enabled == true) : ?>
                    <div class="section-broken__cta">
                        <?php if ($feature_cta_url_1) : ?>
                            <a href="<?= $feature_cta_url_1['url']; ?>" class="flex self-start justify-start items-center gap-2 text-black mt-4" target="<?= $feature_cta_url_1['target']; ?>">
                                <?= $feature_cta_url_1['title']; ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($feature_cta_url_2) : ?>
                            <a href="<?= $feature_cta_url_2['url']; ?>" class="flex self-start justify-start items-center gap-2 text-black mt-4" target="<?= $feature_cta_url_2['target']; ?>">
                                <?= $feature_cta_url_2['title']; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
        <!-- <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8 flex flex-col gap-4">

        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 section-broken__col--l position-relative">
                    <div class="section-broken__img position-relative">
                        <?php if ($feature_video_enabled == true) : ?>
                            <div class="section-broken--video__play">
                                <a href="<?= $feature_video_url; ?>" class="mn-video-pop-btn">
                                    <img src="<?= get_template_directory_uri() . '/assets/dist/img/video-play.png'; ?>" alt="">
                                </a>
                            </div>
                        <?php endif; ?>
                        <img src="<?= $feature_image_url; ?>" alt="" class="img-fluid section-broken__image">
                    </div>
                </div>
                <div class="col-12 col-md-6 section-broken__col--s position-relative">
                    <div class="section-broken__content-wrap">
                        <div class="section-broken__content">
                            <h2 class="mn-title">
                                <?= $feature_title; ?>
                            </h2>
                            <div class="section-broken__txt">
                                <?= $feature_description; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </section>
    <?php
    array_push($has_section,  $section_id . '/' . $feature_title);
    ?>
<?php endif; ?>