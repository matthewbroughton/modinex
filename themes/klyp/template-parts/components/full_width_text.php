<?php

$post_type = get_post_type();
//Settings
$section_show           = get_sub_field('component_full_width_text_component_enabled');
$section_id             = get_sub_field('component_full_width_text_field_id');
$section_class          = get_sub_field('component_full_width_text_field_class');

$type                   = get_sub_field('component_full_width_text_type');
$title                  = get_sub_field('component_full_width_text_title');
$description            = get_sub_field('component_full_width_text_description');
?>
<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> border-x border-black mx-4 sm:mx-6 <?=$post_type == 'post' ? 'pt-16 pb-8 -mb-8 last:mb-0' : 'py-16 sm:py-24 lg:py-36' ?>">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-6 sm:px-8">
                <div class="flex flex-col max-w-prose mx-auto">
                    <article class="prose">
                    <<?= $type; ?> class="text-3xl mb-4">
                        <?= $title; ?>
                    </<?= $type; ?>>
                    <?= $description; ?>
                    </article>
                </div>
        </div>
    </section>
<?php endif; ?>
