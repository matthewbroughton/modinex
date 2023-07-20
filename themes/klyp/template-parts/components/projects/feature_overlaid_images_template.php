<?php if ($section_show == true) :
    //True mean this is overlaid images layout
    if ($section_layout == true) : ?>
        <section id="<?= $section_id; ?>" class="<?= $section_class; ?> section-gallery section-gallery--overlap border-x border-black mx-4 sm:mx-6 py-8 sm:py-16 lg:py-24">
            <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="section-gallery--overlap__col row-span-full gallery-4-1 lg:row-start-1 lg:row-end-3 lg:col-start-1 lg:col-end-3">
                        <a href="<?= $feature_image1; ?>" class="mn-project-pop-btn">
                            <img src="<?= $feature_image1; ?>" alt="" class="w-full h-full object-cover">
                        </a>
                    </div>
                    <div class="section-gallery--overlap__col gallery-4-2 lg:col-span-2">
                        <a href="<?= $feature_image2; ?>" class="mn-project-pop-btn">
                            <img src="<?= $feature_image2; ?>" alt="" class="w-full h-full object-cover">
                        </a>
                    </div>
                    <div class="section-gallery--overlap__col col-12 col-lg-4 gallery-4-3 section-gallery--overlap__col--overlap">
                        <a href="<?= $feature_image3; ?>" class="mn-project-pop-btn">
                            <img src="<?= $feature_image3; ?>" alt="" class="w-full h-full object-cover">
                        </a>
                    </div>
                    <div class="section-gallery--overlap__col col-12 col-lg-8 gallery-4-4">
                        <a href="<?= $feature_image4; ?>" class="mn-project-pop-btn">
                            <img src="<?= $feature_image4; ?>" alt="" class="w-full h-full object-cover">
                        </a>
                    </div>
                </div>
            </div>
        </section>
    <?php else : ?>
        <section class="mn-section section-gallery border-x border-black mx-4 sm:mx-6 py-8 sm:py-16 lg:py-24">
            <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div class="section-gallery__col lg:row-start-1 lg:row-end-3 lg:col-start-1 lg:col-end-3 section-gallery__col--random section-gallery__col--0 gallery-5-1">
                        <a href="<?= $feature_image1; ?>" class="mn-project-pop-btn">
                            <img src="<?= $feature_image1; ?>" alt="" class="w-full h-full object-cover">
                        </a>
                    </div>
                    <div class="section-gallery__col section-gallery__col--random section-gallery__col--1 gallery-5-2">
                        <a href="<?= $feature_image2; ?>" class="mn-project-pop-btn">
                            <img src="<?= $feature_image2; ?>" alt="" class="w-full h-full object-cover">
                        </a>
                    </div>
                    <div class="section-gallery__col section-gallery__col--random section-gallery__col--2 gallery-5-3">
                        <a href="<?= $feature_image3; ?>" class="mn-project-pop-btn">
                            <img src="<?= $feature_image3; ?>" alt="" class="w-full h-full object-cover">
                        </a>
                    </div>
                    <div class="section-gallery__col section-gallery__col--random section-gallery__col--3 gallery-5-4">
                        <a href="<?= $feature_image4; ?>" class="mn-project-pop-btn">
                            <img src="<?= $feature_image4; ?>" alt="" class="w-full h-full object-cover">
                        </a>
                    </div>
                    <div class="section-gallery__col lg:col-start-3 lg:col-end-6 section-gallery__col--random section-gallery__col--4 gallery-5-5">
                        <a href="<?= $feature_image5; ?>" class="mn-project-pop-btn">
                            <img src="<?= $feature_image5; ?>" alt="" class="w-full h-full object-cover">
                        </a>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;
endif; ?>