<?php

$post_type = get_post_type();
//Settings
$section_show           = get_sub_field('component_callout_banner_component_enabled');
$section_id             = get_sub_field('component_callout_banner_field_id');
$section_class          = get_sub_field('component_callout_banner_field_class');
$section_layout         = get_sub_field('component_callout_banner_layout_type');
$layout_class           = $section_layout == 'left' ? 'md:order-last' : '';
$divide_reverse         = $section_layout == 'left' ? 'md:divide-x-reverse' : '';

$feature_tile           = get_sub_field('component_callout_banner_title');
$feature_image_url      = get_sub_field('component_callout_banner_feature_image');
$feature_layout_type    = get_sub_field('component_callout_banner_layout_type');
$feature_description    = get_sub_field('component_callout_banner_feature_description');
$feature_cta_enabled    = get_sub_field('component_callout_banner_cta_enabled');
$feature_cta_url        = get_sub_field('component_callout_banner_cta_url');
$feature_cta_text        = get_sub_field('component_callout_banner_cta_text');
?>
<?php if ($section_show == true) : ?>
	<section id="<?= $section_id; ?>" class="<?= $section_class; ?> border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36">
		<div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-6 md:px-8">
			<div class="grid grid-cols-1 md:grid-cols-2 divide-black divide-y md:divide-y-0 md:divide-x border border-black <?= $divide_reverse; ?>">
				<div class="<?= $layout_class; ?>">
					<img src="<?= $feature_image_url; ?>" alt="" class="h-full object-cover w-full">
				</div>
				<div class="px-6 py-8 md:py-12 md:px-12 flex items-center bg-white">
					<div class="flex flex-col">
						<?php if ($feature_tile) : ?>
							<h2 class="mb-4 text-3xl">
								<?= $feature_tile; ?>
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
