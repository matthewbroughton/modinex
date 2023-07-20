<?php
    //Settings
    $section_show           = get_sub_field('component_sidebyside_component_enabled');
    $section_id             = get_sub_field('component_sidebyside_field_id');
    $section_class          = get_sub_field('component_sidebyside_field_class');

    //Contents
    $column_repeater        = get_sub_field('component_sidebyside_repeater');
?>
<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36 section-two-clad">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2">
                <?php foreach ($column_repeater as $column) { ?>
                    <div class="position-relative">
                        <div class="section-two-clad__img position-relative">
                            <img src="<?= $column['feature_image']; ?>" alt="<?= $column['title']; ?>" class="img-fluid">
                        </div>
                        <div class="section-two-clad__con">
                            <h2 class="mn-title">
                                <?= $column['title']; ?>
                            </h2>
                            <div class="section-two-clad__txt">
                                <?= $column['feature_description']; ?>
                            </div>
                            <?php if ($column['enable_cta'] == true) : ?>
                                <?php if ($column['cta_url']) : ?>
                                    <div class="section-two-clad__link">
                                        <a href="<?= $column['cta_url']; ?>" class="mn-hover-scale-img-arrow"><img src="<?= get_template_directory_uri() . '/assets/dist/img/arrow-right.svg'; ?>" class="img-fluid"></a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
            <?php } ?>
            </div>
        </div>
    </section>
<?php endif; ?>