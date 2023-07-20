<?php
$post_type = get_post_type();
//Settings
if ($post_type == 'project') {
    //Settings As Project Component
    $section_show = get_field('page_hero')['enable_component'];
    $section_id = get_field('page_hero')['id'];
    $section_class = get_field('page_hero')['class'];

    $feature_tile = get_field('page_hero')['hero_title'];
    $feature_description = get_field('page_hero')['hero_description'];
    $feature_image_url = get_field('page_hero')['image'];
} else {
    //Settings As Page
    $section_show = get_sub_field('component_hero_component_enabled');
    $section_id = get_sub_field('component_hero_field_id');
    $section_class = get_sub_field('component_hero_field_class');

    $feature_tile = get_sub_field('component_hero_title');
    $feature_description = get_sub_field('component_hero_description');
    $feature_image_url = get_sub_field('component_hero_image');

    $feature_cta_enabled    = get_sub_field('component_hero_cta_enabled');
    $feature_cta_url_1      = get_sub_field('component_hero_cta_url_1');
    $feature_cta_url_2      = get_sub_field('component_hero_cta_url_2');
}
?>
<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> relative overflow-hidden min-h-[24rem] lg:min-h-[36rem] flex items-center -mb-px">
        <?php
        if ($feature_image_url) {
        ?>
            <div class="bg-black opacity-50 absolute inset-0 z-0"></div>
            <img src="<?= $feature_image_url; ?>" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">
        <?php } ?>
        <div class="z-10 mx-auto max-w-screen-lg xl:max-w-screen-xl w-full mt-4">
            <div class="w-full max-w-screen-lg xl:max-w-screen-xl lg:max-w-screen-md flex flex-col px-6 sm:px-12">
                <div class="max-w-screen-sm">
                    <h1 class="text-3xl lg:text-4xl text-white font-light">
                        <?= $feature_tile; ?>
                    </h1>
                    <div class="text-white mt-2">
                        <?= $feature_description; ?>
                    </div>
                </div>
                <?php if ($feature_cta_enabled == true) : ?>
                    <div class="flex flex-col sm:flex-row gap-4 mt-8">
                        <?php if ($feature_cta_url_1) : ?>
                            <a class="border border-white flex justify-between items-center gap-2 rounded-full text-white py-2 px-4 lg:min-w-[16.875rem] transition hover:bg-white hover:text-black" href="<?= $feature_cta_url_1['url']; ?>" target="<?= $feature_cta_url_1['target']; ?>"><span><?= $feature_cta_url_1['title']; ?></span> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" /></svg></a>
                        <?php endif; ?>
                        <?php if ($feature_cta_url_2) : ?>
                            <a class="border border-white flex justify-between items-center gap-2 rounded-full text-white py-2 px-4 lg:min-w-[16.875rem] transition hover:bg-white hover:text-black" href="<?= $feature_cta_url_2['url']; ?>" target="<?= $feature_cta_url_2['target']; ?>"><span><?= $feature_cta_url_2['title']; ?></span> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" /></svg></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
