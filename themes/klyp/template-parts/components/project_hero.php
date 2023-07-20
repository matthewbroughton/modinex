<?php
//Settings
$section_show           = get_sub_field('component_hero_component_enabled');
$section_id             = get_sub_field('component_hero_field_id');
$section_class          = get_sub_field('component_hero_field_class');

$feature_tile = get_sub_field('component_hero_title');
$feature_description = get_sub_field('component_hero_description');
$feature_image_url = get_sub_field('component_hero_image');

?>
<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> section-br-banner position-relative">
        <div class="section-br-banner__img">
            <img src="<?= $feature_image_url; ?>" alt="" class="img-fluid">
        </div>
        <div class="section-br-banner__content position-absolute">
            <h1 class="section-br-banner__title mn-title--big">
                <?= $feature_tile; ?>
            </h1>
            <div class="mn-short__text">
                <?= $feature_description; ?>
            </div>
        </div>
    </section>
<?php endif; ?>