<?php

$post_type = get_post_type();
//Settings
$section_show           = get_sub_field('component_feature_call_to_action_component_enabled');
$section_id             = get_sub_field('component_feature_call_to_action_field_id');
$section_class          = get_sub_field('component_feature_call_to_action_field_class');
$section_layout         = get_sub_field('component_feature_call_to_action_layout_type');
$layout_class           = $section_layout == 'left' ? 'sm:order-last' : '';
$divide_reverse         = $section_layout == 'left' ? 'sm:divide-x-reverse' : '';
$push_text              = $section_layout == 'left' ? 'ml-auto' : '';

$feature_title           = get_sub_field('component_feature_call_to_action_title');
$feature_image_url      = get_sub_field('component_feature_call_to_action_feature_image');
$feature_video_enabled  = get_sub_field('component_feature_call_to_action_video_enabled');
$feature_video_url      = get_sub_field('component_feature_call_to_action_video_url');
$feature_layout_type    = get_sub_field('component_feature_call_to_action_layout_type');
$feature_description    = get_sub_field('component_feature_call_to_action_feature_description');
$feature_cta_enabled    = get_sub_field('component_feature_call_to_action_cta_enabled');
$feature_cta_url        = get_sub_field('component_feature_call_to_action_cta_url');
$feature_cta_text        = get_sub_field('component_feature_call_to_action_cta_text');
?>
<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> border-x border-black mx-4 sm:mx-6 <?=$post_type == 'post' ? 'py-16' : '' ?>">
        <div class="grid grid-cols-1 sm:grid-cols-2 divide-black <?= $post_type == 'post' ? 'max-w-screen-lg xl:max-w-screen-xl mx-auto w-full' : 'divide-y sm:divide-y-0 sm:divide-x ' . $divide_reverse; ?>">
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
                        <h2 class="mb-4 text-3xl">
                            <?= $feature_title; ?>
                        </h2>
                        <div>
                            <?= $feature_description; ?>
                        </div>
                    </div>
                    <?php if ($feature_cta_enabled == true) : ?>
                        <a class="flex self-start justify-start items-center gap-2 text-black mt-4 group" href="<?= $feature_cta_url; ?>"><span><?= $feature_cta_text ?></span> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 transition lg:group-hover:translate-x-1"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" /></svg></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
