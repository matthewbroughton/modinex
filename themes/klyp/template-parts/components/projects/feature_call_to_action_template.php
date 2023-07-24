<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> border-x border-black mx-4 sm:mx-6">
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
                <div class="flex flex-col max-w-full <?= $push_text; ?>">
                    <div class="max-w-md">
                        <?php if ($feature_title) : ?>
                            <h2 class="mb-4 text-3xl">
                                <?= $feature_title; ?>
                            </h2>
                        <?php endif; ?>
                        <div>
                            <?= $feature_description; ?>
                        </div>
                        <?php if ($feature_cta_enabled == true) : ?>
                            <a class="flex self-start justify-start items-center gap-2 text-black mt-4" href="<?= $feature_cta_url; ?>"><span><?= $feature_cta_text ?></span> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" /></svg></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
