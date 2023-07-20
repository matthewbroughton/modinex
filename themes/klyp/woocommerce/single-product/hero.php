<?php
//Settings
$section_show = get_field('product_details_hero')['enable_component'];
$section_id = get_field('product_details_hero')['id'];
$section_class = get_field('product_details_hero')['class'];

$feature_image_url = get_field('product_details_hero')['image'];
?>
<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> relative h-80 lg:h-[42rem] overflow-hidden">
        <div class="h-full bg-cover bg-center" style="background-image: url('<?= $feature_image_url; ?>');"></div>
    </section>
<?php endif; ?>