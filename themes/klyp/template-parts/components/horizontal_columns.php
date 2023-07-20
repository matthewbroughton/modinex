<?php
    //Settings
    $section_show           = get_sub_field('component_horizontal_columns_component_enabled');
    $section_id             = get_sub_field('component_horizontal_columns_field_id');
    $section_class          = get_sub_field('component_horizontal_columns_field_class');

    $section_layout         = get_sub_field('component_horizontal_columns_layout');

    if ($section_layout == 'two') {
        $layout_class = 'md:grid-cols-2 hc2';
    } elseif ($section_layout == 'three') {
        $layout_class = 'lg:grid-cols-3 hc3';
    } elseif ($section_layout == 'four') {
        $layout_class = 'lg:grid-cols-4 hc4';
    }

    $image_layout           = get_sub_field('component_horizontal_columns_image_ratio');
    $display_border           = get_sub_field('component_horizontal_columns__image_border');
    $image_border           = $display_border === true ? 'border border-gray-100' : '';

    if ($image_layout == '1:1') {
        $image_ratio = 'aspect-w-1 aspect-h-1';
    } elseif ($image_layout == '16:9') {
        $image_ratio = 'aspect-w-16 aspect-h-9';
    } elseif ($image_layout == '4:3') {
        $image_ratio = 'aspect-w-4 aspect-h-3';
    } elseif ($image_layout == '3:4') {
        $image_ratio = 'aspect-w-3 aspect-h-4';
    } elseif ($image_layout == '9:16') {
        $image_ratio = 'aspect-w-9 aspect-h-16';
    } else {
        $image_ratio = '';
    }

    //Contents
    $title                  = get_sub_field('component_horizontal_columns_heading');
    $column_repeater        = get_sub_field('component_horizontal_columns_repeater');
?>
<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> horizontal-columns border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36">
        <div class="max-w-screen-xl mx-auto w-full px-8 flex flex-col gap-4">
            <?php if($title): ?>
                <div class="flex flex-col-reverse lg:flex-row gap-4 items-center">
                    <h2 class="text-3xl lg:text-4xl font-light">
                        <?= $title; ?>
                    </h2>
                </div>
                <hr class="border-t w-full my-4 border-black">
            <?php endif; ?>
            <div class="grid grid-cols-1 <?= $layout_class; ?> divide-y divide-black md:divide-y-0 gap-8 md:-ml-8">
                <?php foreach ($column_repeater as $column) { ?>
                    <div class="hc-item pt-8 first:pt-0 md:pt-0 md:pl-8 flex flex-col gap-8 md:first:border-l-0 md:border-l md:border-black">
                        <?php if($column['feature_image'] != null) : ?>
                            <?php if($column['clickable_images'] == 1 && ! empty($column['feature_link']['url'])) : ?>
                                <?php if (! empty($column['feature_link']['url'])) : ?>
                                    <a href="<?= $column['feature_link']['url']; ?>" target="<?= $column['feature_link']['target']; ?>" class="<?= $image_border; ?> <?= $image_ratio; ?>">
                                        <img src="<?= $column['feature_image']; ?>" alt="" class="h-full w-full object-cover">
                                    </a>
                                <?php endif; ?>
                            <?php else : ?>
                                <div class="<?= $image_ratio; ?> <?= $image_border; ?>">
                                    <img src="<?= $column['feature_image']; ?>" alt="" class="h-full w-full object-cover">
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="flex flex-col flex-1">
                            <?php if ($column['subtitle']) : ?>
                            <h4 class="text-sm text-gray-400"><?= $column['subtitle'] ?></h4>
                            <?php endif; ?>
                            <h2 class="text-2xl mb-2"><?= $column['title']; ?></h2>
                            <?php if(! empty($column['feature_description'])) : ?>
                                <div class="mb-4">
                                    <?= $column['feature_description']; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (! empty($column['feature_link']['url'])) : ?>
                                <div class="flex md:mt-auto">
                                    <a class="flex self-start justify-start items-center gap-2 text-black mt-4 sm:mt-0 group" href="<?= $column['feature_link']['url']; ?>" target="<?= $column['feature_link']['target']; ?>"><span><?= $column['feature_link']['title'] ?></span> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 transition duration-300 group-hover:translate-x-2"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" /></svg></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php endif; ?>
