<?php
    //Settings
    $section_show           = get_field('product_details_horizontal_column')['enable_mobile'];
    $section_id             = get_field('product_details_horizontal_column')['id'] ? get_field('product_details_how_it_works')['id'] : 'section-selling';;
    $section_class          = get_field('product_details_horizontal_column')['class'];

    //Contents
    $heading                = get_field('product_details_horizontal_column')['horizontal_columns_heading'];
    $column_repeater        = get_field('product_details_horizontal_column')['horizontal_columns_repeater'];
?>
<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> border-x border-black mx-4 sm:mx-6 py-8 sm:py-24">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8 flex flex-col gap-4">
            <div class="mb-4">
                <h3 class="text-3xl">
                    <?php echo $heading; ?>
                </h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-black gap-4 md:gap-8 md:-ml-8 horizontal_col">
                <?php foreach ($column_repeater as $column) { ?>
                    <div class="col_item pt-4 md:pt-0 md:pl-8">
                        <div class="h-96 md:h-64 mb-4">
                            <img src="<?= $column['feature_image']; ?>" alt="" class="h-full w-full object-cover">
                        </div>
                        <div class="">
                            <h2 class="text-xl"><?= $column['title']; ?></h2>
                            <div class="">
                                <?= $column['feature_description']; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php endif; ?>
