<?php

//Settings

if (have_rows('brand_history_repeater')) :

	while ( have_rows('brand_history_repeater') ) : the_row();
		// Section selectors
		$section_id           = get_sub_field('brand_history_field_id');
		$section_class        = get_sub_field('brand_history_field_class');

		// Section Content
		$milestone_title        = get_sub_field('milestone_title');
		$milestone_description  = get_sub_field('milestone_description');
		$milestone_year         = get_sub_field('milestone_year');
		$img 					= get_sub_field('milestone_image');

		// Section Layout
		$section_layout         = get_sub_field('brand_history_layout_type');

		if ($section_layout == 'top') {
			$layout_class = 'flex flex-col gap-4 md:gap-12';
		} elseif ($section_layout == 'bottom') {
			$layout_class = 'flex flex-col sm:flex-col-reverse gap-4 md:gap-12';
		} elseif ($section_layout == 'left') {
			$layout_class = 'flex flex-col sm:flex-row gap-4 md:gap-12';
		} elseif ($section_layout == 'right') {
			$layout_class = 'flex flex-col sm:flex-row-reverse gap-4 md:gap-12';
		}
	?>
	<section id="<?= $section_id; ?>" class="border-x border-black mx-4 sm:mx-6 <?= $section_class; ?>">
		<div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8 flex flex-col md:flex-row sm:gap-8 sm:divide-x sm:divide-black">
			<div class="md:w-3/4 order-2 md:order-none pt-0 py-8 sm:py-20 <?= $layout_class ?>">
				<?php if ($img) : ?>
					<div class="w-auto max-w-full flex-grow basis-full">
						<img src="<?= $img ?>" alt="" class="h-full w-full object-cover">
					</div>
				<?php endif; ?>
				<div class="flex flex-col gap-4 flex-shrink">
					<h2 class="text-3xl lg:text-4xl"><?= $milestone_title ?></h2>
					<?= $milestone_description ?>
				</div>
			</div>
			<div class="md:w-1/4 order-1 md:order-none flex flex-col py-8 sm:py-20">
				<?php if (have_rows('brand_history_supplemental_years')) : ?>
					<div class="md:flex-col md:justify-around md:items-end h-full hidden md:flex">
						<?php while ( have_rows('brand_history_supplemental_years') ) : the_row(); ?>
							<div class="opacity-50 text-3xl"><?= the_sub_field('additional_year') ?></div>
						<?php endwhile; ?>
					</div>
				<?php endif ?>
				<div class="flex md:mt-auto">
					<span class="border-b border-black flex-1"></span>
					<h3 class="text-5xl">
						<?= $milestone_year ?>
					</h3>
				</div>
			</div>
		</div>
	</section>
	<?php endwhile ?>
<?php endif; ?>