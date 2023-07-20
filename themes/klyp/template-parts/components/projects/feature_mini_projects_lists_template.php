<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> border-x border-black mx-4 sm:mx-6 py-8 sm:py-24 section-selling section-similar">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8 flex flex-col gap-4">
            <div class="flex flex-col sm:flex-row gap-4 sm:items-center justify-between mb-8">
                <h2 class="text-3xl lg:text-4xl font-light lg:max-w-screen-sm">
                    Relevant Projects
                </h2>
                <a class="flex justify-start items-center gap-2 text-black" href="<?= site_url('projects'); ?>"><span>View all</span> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" /></svg></a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-black gap-8 md:-ml-8">
                <?php for ($i = 0; $i < count($feature_project_image_title); $i++) { ?>
                    <div class="flex flex-col gap-4 pt-4 md:pt-0 md:pl-8">
                        <a href="<?= $feature_project_image_link[$i]; ?>" class="flex flex-col">
                            <div class="w-full aspect-w-16 aspect-h-9 mb-4">
                                <img src="<?= $feature_project_image_url[$i]; ?>" alt="" class="h-full w-full object-cover">
                            </div>
                            <div class="flex items-center justify-between gap-8 mb-4">
                                <h2 class="text-xl"><?= $feature_project_image_title[$i]; ?></h2>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 flex-shrink-0">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </div>
                            <?= $feature_project_image_description[$i]; ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php endif; ?>