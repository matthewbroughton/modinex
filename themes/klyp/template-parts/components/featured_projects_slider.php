<?php

$post_type = get_post_type();
//Settings
$section_show           = get_sub_field('component_featured_projects_component_enabled');
$section_id             = get_sub_field('component_featured_projects_field_id');
$section_class          = get_sub_field('component_featured_projects_field_class');

$title                  = get_sub_field('component_featured_projects_title');
$show_link              = get_sub_field('component_featured_projects_link_enabled');
$feature_link           = get_sub_field('component_featured_projects_link');
$featured_projects 		= get_sub_field('component_featured_projects_grid_items');

?>
<?php if ($section_show == true) : ?>
	<section id="<?= $section_id; ?>" class="<?= $section_class; ?> border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36">
		<div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-6 sm:px-8">
			<div class="flex flex-col sm:flex-row gap-4 sm:items-center justify-between mb-8">
				<h2 class="text-3xl lg:text-4xl font-light lg:max-w-screen-sm">
					<?= $title; ?>
				</h2>
				<?php if ($show_link == 1) : ?>
				<a class="flex self-start justify-start items-center gap-2 text-black" href="<?= $feature_link[url] ?>"><span>View all</span> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" /></svg></a>
				<?php endif; ?>
			</div>
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 md:divide-black md:divide-x gap-x-4 md:gap-x-0 gap-y-8 md:gap-y-12 md:-mx-8">
				<?php if( $featured_projects ): ?>
					<?php foreach($featured_projects as $projects ):
						$permalink = get_permalink( $projects->ID );
						$title = get_the_title( $projects->ID );
						$img = get_the_post_thumbnail_url( $projects->ID );
						$location = get_field( 'project_location', $projects->ID );
						$year = get_field( 'project_year', $projects->ID );
					?>
						<div class="md:px-8">
								<a href="<?= $permalink ?>">
									<?php if ($img) : ?>
									<div class="w-full aspect-w-16 aspect-h-9 mb-4">
										<img src="<?= $img ?>" alt="" class="h-full w-full object-cover">
									</div>
									<?php endif; ?>
									<div class="flex flex-col gap-1">
										<h3 class="text-lg text-black"><?= $title ?></h3>
										<div class="text-gray-600 text-sm">
											<?= $location ?> <span>&mdash;</span> <?= $year ?>
										</div>
									</div>
								</a>
						</div>

					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif; ?>
