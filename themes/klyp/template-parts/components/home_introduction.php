<?php

$post_type = get_post_type();

if ($post_type == 'project') {
    //Settings As Project Component
    $section_show = get_field('projects_home_introduction')['enable_component'];
    $section_id = get_field('projects_home_introduction')['id'];
    $section_class = get_field('projects_home_introduction')['class'];

    //Contents
    $title = get_field('projects_home_introduction')['title'];
    $subtitle = get_field('projects_home_introduction')['subtitle'];
    $byline = get_field('projects_home_introduction')['byline'];
    $divider = get_field('projects_home_introduction')['enable_divider'];
    $divider_class = $divider == 1 ? '' : 'mb-12';

    $feature_video_enabled  = get_field('projects_home_introduction')['enable_video'];
    $feature_video_type  = get_field('projects_home_introduction')['video_type'];

    $feature_video_embed      = get_field('projects_home_introduction')['video_embed'];
    $feature_video_url      = get_field('projects_home_introduction')['video_url'];
    $feature_image_url      = get_field('projects_home_introduction')['video_cover'];

    $feature_cta_enabled    = get_field('projects_home_introduction')['enable_cta'];
    $feature_cta_url_1      = get_field('projects_home_introduction')['cta_url_1'];
    $feature_cta_url_2      = get_field('projects_home_introduction')['cta_url_2'];

} else {
    //Settings as General Component
    $section_show = get_sub_field('component_home_introduction_component_enabled');
    $section_id = get_sub_field('component_home_introduction_field_id');
    $section_class = get_sub_field('component_home_introduction_field_class');

    //Contents
    $title = get_sub_field('component_home_introduction_title');
    $subtitle = get_sub_field('component_home_introduction_subtitle');
    $byline = get_sub_field('component_home_introduction_byline');
    $divider = get_sub_field('component_home_introduction_show_divider');
    $divider_class = $divider == 1 ? '' : 'mb-12';

    $feature_video_enabled  = get_sub_field('component_home_introduction_video_enabled');
    $feature_video_type  = get_sub_field('component_home_introduction_video_type');

    $feature_video_embed      = get_sub_field('component_home_introduction_video_embed');
    $feature_video_url      = get_sub_field('component_home_introduction_video_url');
    $feature_image_url      = get_sub_field('component_home_introduction_video_cover');

    $feature_cta_enabled    = get_sub_field('component_home_introduction_cta_enabled');
    $feature_cta_url_1      = get_sub_field('component_home_introduction_cta_url_1');
    $feature_cta_url_2      = get_sub_field('component_home_introduction_cta_url_2');
}
?>

<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> border-x border-black mx-4 sm:mx-6 py-16 sm:py-24">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
            <div class="flex flex-col-reverse lg:flex-row gap-4 items-center justify-between <?= $divider_class  ?>">
                <h2 class="text-3xl lg:text-4xl font-light lg:max-w-screen-sm">
                    <?= $title; ?>
                </h2>
                <div class="w-48 self-start">
                    <img src="<?= get_stylesheet_directory_uri(); ?>/assets/dist/img/logo/Modinex_Logo_Wordmark_Positive_Transparent_RGB.png" alt="Modinex word mark in dark grey">
                </div>
            </div>
            <?php if ($divider) : ?>
                <hr class="border-t w-full my-12 md:my-16 border-black">
            <?php endif; ?>
            <div class="flex flex-col lg:flex-row gap-4">
                <?php if ($subtitle) :?>
                <h4 class="flex-grow text-lg"><?= $subtitle; ?></h4>
                <?php endif; ?>
                <div class="lg:flex-shrink-0 lg:w-3/4">
                    <div class="lg:max-w-screen-md">
                        <div class="text-lg">
                            <?= $byline; ?>
                        </div>
                        <?php if ($feature_cta_enabled == true) : ?>
                            <div class="flex flex-col sm:flex-row gap-4 mt-8">
                                <?php if ($feature_cta_url_1) : ?>
                                    <a class="border border-black flex justify-between items-center gap-2 rounded-full text-black py-2 px-4 transition hover:bg-black/10" href="<?= $feature_cta_url_1['url']; ?>" target="<?= $feature_cta_url_1['target']; ?>"><span><?= $feature_cta_url_1['title']; ?></span> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" /></svg></a>
                                <?php endif; ?>
                                <?php if ($feature_cta_url_2) : ?>
                                    <a class="border border-black flex justify-between items-center gap-2 rounded-full text-black py-2 px-4 transition hover:bg-black/10" href="<?= $feature_cta_url_2['url']; ?>" target="<?= $feature_cta_url_2['target']; ?>"><span><?= $feature_cta_url_2['title']; ?></span> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" /></svg></a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if ($feature_video_enabled == true) : ?>
                <?php if ($feature_video_type == 'embed') :?>
                <div class="embed-container mt-16">
                    <?= $feature_video_embed ?>
                </div>
                <?php else: ?>
                    <video class="mt-16" src="<?= $feature_video_url; ?>" poster="<?= $feature_image_url; ?>" controls></video>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>