<?php
	$post_type = get_post_type();
	//Settings as General Component
	$section_show = get_sub_field('component_text_tabs_component_enabled');
	$section_id = get_sub_field('component_text_tabs_field_id');
	$section_class = get_sub_field('component_text_tabs_field_class');

	//Contents
	$title = get_sub_field('component_text_tabs_title');
?>

<?php if ($section_show == true) : ?>
	<section id="<?= $section_id; ?>" class="<?= $section_class; ?> border-x border-black mx-4 sm:mx-6 <?=$post_type == 'post' ? 'pt-4 sm:pt-8' : 'pt-8 sm:pt-16'?>">
		<div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
			<?php if( have_rows('component_text_tabs_tabs_repeater') ):
			   $i = 1;
			   $uniqueId = uniqid();
			?>
				<div class="tabs">
					<?php if($title): ?>
						<div class="py-8 border-b border-black">
							<h4 id="tablist-title" class="text-3xl"><?= $title ?></h4>
						</div>
					<?php endif; ?>
					<div class="grid lg:grid-cols-[max-content_minmax(0,_1fr)] divide-y md:divide-y-0 md:divide-x divide-black">
						<div class="pt-8 md:pt-16 md:pr-16 pb-8 sm:pb-16">
							<div class="automatic flex flex-col justify-start gap-4" role="tablist" aria-labelledby="tablist-title">
								<?php
									while ( have_rows('component_text_tabs_tabs_repeater') ) : the_row();
										$header = get_sub_field('component_text_tabs_tabs_repeater_title');
										$content = get_sub_field('component_text_tabs_tabs_repeater_content');
								?>
								<button id="tab-<?php echo $uniqueId?>-<?php echo $i; ?>" class="before:content-['–'] before:mr-2 text-left focus-visible:ring-2 ring-offset-1 focus-visible:outline-0 text-base text-gray-400 hover:text-gray-600 transition <?=$i === 1 ? 'text-black' : 'text-gray-400'?>" type="button" role="tab" aria-selected="true" aria-controls="tabpanel-<?php echo $uniqueId?>-<?php echo $i; ?>">
								  <?= $header ?>
								</button>
								<?php
										$i++;
									endwhile; //End the loop
								?>
							</div>
						</div>
						<div class="pt-8 md:pt-16 md:pl-24 lg:pl-32 pb-8 sm:pb-16">
							<?php
								$i = 1;
								while ( have_rows('component_text_tabs_tabs_repeater') ) : the_row();
									$header = get_sub_field('component_text_tabs_tabs_repeater_title');
									$content = get_sub_field('component_text_tabs_tabs_repeater_content');
							?>

							<div id="tabpanel-<?php echo $uniqueId?>-<?php echo $i ?>" role="tabpanel" tabindex="0" aria-labelledby="tab-<?php echo $uniqueId?>-<?php echo $i ?>" class="<?=$i != 1 ? 'is-hidden' : ''?>">
								<h4 class="text-lg mb-6"><?= $header ?></h4>
								<div><?= $content ?></div>
							</div>

							<?php
									$i++;
								endwhile; //End the loop
							?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>