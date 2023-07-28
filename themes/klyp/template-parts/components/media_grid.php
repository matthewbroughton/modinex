<?php
$post_type = get_post_type();
//Settings
$section_show           = get_sub_field('component_media_grid_component_enabled');
$section_id             = get_sub_field('component_media_grid_field_id');
$section_class          = get_sub_field('component_media_grid_field_class');

$section_layout         = get_sub_field('component_media_grid_layout');

if ($section_layout == 'two') {
	$layout_class = 'md:grid-cols-2 hc2';
} elseif ($section_layout == 'three') {
	$layout_class = 'lg:grid-cols-3 hc3';
} elseif ($section_layout == 'four') {
	$layout_class = 'lg:grid-cols-4 hc4';
}

$image_layout           = get_sub_field('component_media_grid_image_ratio');

if ($image_layout == '1:1') {
	$image_ratio = 'aspect-w-1 aspect-h-1';
} elseif ($image_layout == '16:9') {
	$image_ratio = 'aspect-w-16 aspect-h-9';
} elseif ($image_layout == '4:3') {
	$image_ratio = 'aspect-w-4 aspect-h-3';
} elseif ($image_layout == '3:4') {
	$image_ratio = 'aspect-w-3 aspect-h-4';
} elseif ($image_layout == '9:16') {
	$image_ratio = 'aspect-w-9 aspect-h-16';
} else {
	$image_ratio = '';
}

$title                  = get_sub_field('component_media_grid_title');

?>
<?php if ($section_show == true) : ?>
	<section id="<?= $section_id; ?>" class="<?= $section_class; ?> border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36">
		<div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-6 sm:px-8">
			<div class="flex flex-col-reverse lg:flex-row gap-4 items-center justify-between mb-8">
				<h2 class="text-3xl lg:text-4xl font-light lg:max-w-screen-sm">
					<?= $title; ?>
				</h2>
			</div>
			<div class="grid grid-cols-1 <?= $layout_class; ?> divide-y divide-black md:divide-y-0 gap-8 md:-ml-8">
				<?php if( have_rows('component_media_grid_repeater') ): ?>
					<?php
						while ( have_rows('component_media_grid_repeater') ) : the_row();
							$subtitle = get_sub_field('component_media_grid_repeater_subtitle');
							$title = get_sub_field('component_media_grid_repeater_title');
							$img = get_sub_field('component_media_grid_repeater_image');
							$url = get_sub_field('component_media_grid_repeater_url');
					?>
						<div class="hc-item pt-8 first:pt-0 md:pt-0 md:pl-8 flex flex-col gap-8 md:first:border-l-0 md:border-l md:border-black">
							<?php if ($url != null) : ?>
								<a href="<?= $url ?>">
									<?php if ($img) : ?>
									<div class="w-full <?= $image_ratio; ?> mb-4">
										<img src="<?= $img ?>" alt="" class="h-full w-full object-cover">
									</div>
									<?php endif; ?>
									<h4 class="text-xs text-gray-400"><?= $subtitle ?></h4>
									<h3 class="text-lg text-black"><?= $title ?></h3>
								</a>
							<?php else: ?>
								<?php if ($img) : ?>
									<div class="w-full aspect-w-16 aspect-h-9 mb-4">
										<img src="<?= $img ?>" alt="" class="h-full w-full object-cover">
									</div>
								<?php endif; ?>
								<h4 class="text-xs text-gray-400"><?= $subtitle ?></h4>
								<h3 class="text-lg text-black"><?= $title ?></h3>
							<?php endif; ?>
						</div>
					<?php
						endwhile;
					?>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif; ?>
