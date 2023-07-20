<?php
    //Settings
    $section_show     = get_field('product_details_gallery_image')['enable_mobile'];
    $section_id       = get_field('product_details_gallery_image')['id'] ? get_field('product_details_gallery_image')['id'] : 'gallery';
    $section_class    = get_field('product_details_gallery_image')['class'];

    //Contents
    $gallery_index = 1;
    $images = array();
    $gallery = get_field('product_details_gallery_image')['enable_gallery_custom'] == true ? get_field('product_details_gallery_image')['pd_gallery_images_group'] : get_field('gallery_images_group','option');

    foreach ($gallery as $image_url) {
        if ($image_url) {
            $images[$gallery_index] = $image_url;
            $gallery_index++;
        }
    }
?>
<?php if ($section_show == true) : ?>
    <section class="bg-white border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36 section-gallery <?= $section_class; ?>" id="<?= $section_id; ?>">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8 flex flex-col gap-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 divide divide-black gap-8">
                <div>
                    <a href="<?php echo $images[1]; ?>" class="mn-product-pop-btn">
                        <img src="<?= $images[1]; ?>" class="w-full h-full object-cover" alt="">
                    </a>
                </div>
                <div>
                    <a href="<?php echo $images[2]; ?>" class="mn-product-pop-btn">
                        <img src="<?= $images[2]; ?>" class="w-full h-full object-cover" alt="">
                    </a>
                </div>
                <div>
                    <a href="<?php echo $images[3]; ?>" class="mn-product-pop-btn">
                        <img src="<?= $images[3]; ?>" class="w-full h-full object-cover" alt="">
                    </a>
                </div>
                <div>
                    <a href="<?php echo $images[4]; ?>" class="mn-product-pop-btn">
                        <img src="<?= $images[4]; ?>" class="w-full h-full object-cover" alt="">
                    </a>
                </div>
                <div>
                    <a href="<?php echo $images[5]; ?>" class="mn-product-pop-btn">
                        <img src="<?= $images[5]; ?>" class="w-full h-full object-cover" alt="">
                    </a>
                </div>
                <div>
                    <a href="<?php echo $images[6]; ?>" class="mn-product-pop-btn">
                        <img src="<?= $images[6]; ?>" class="w-full h-full object-cover" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php
        array_push($has_section, $section_id . '/Gallery');
    ?>
<?php endif; ?>
