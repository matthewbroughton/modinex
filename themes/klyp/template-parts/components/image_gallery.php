<?php
$post_type = get_post_type();
//Settings
$section_show               = get_sub_field('component_image_gallery_component_enabled');
$section_id                 = get_sub_field('component_image_gallery_field_id');
$section_class              = get_sub_field('component_image_gallery_field_class');

//Contents
$gallery_layout             = get_sub_field('gallery_layout');
$gallery_2 					= get_sub_field('2_images_layout_upload');
$gallery_3 					= get_sub_field('3_images_layout_upload');
?>

<?php if ($section_show == true) : ?>
	<section id="<?= $section_id; ?>" class="<?= $section_class; ?> border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36 section-gallery-page">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
			<?php if ($gallery_layout == 2) : ?>
				<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
	        		<?php foreach ($gallery_2 as $key => $gallery_image) : ?>
		            	<div class="">
		                	<img src="<?= $gallery_image; ?>" alt="" class="h-full w-full object-cover">
		            	</div>
		        	<?php endforeach; ?>
				    <div class="col-12">
				        <ul class="section-blog-details__gallery section-blog-details__gallery--two d-flex list-unstyled">
				        </ul>
				    </div>
				</div>
			<?php endif;?>

			<?php if ($gallery_layout == 3) : ?>
				<div class="grid grid-cols-1 sm:grid-cols-6 gap-4">
		        	<?php $g3_col = 2; ?>
		        	<?php foreach ($gallery_3 as $gallery_image) : ?>
						<?php
						if ($g3_col == 2) {
							$col_class = 'sm:col-span-full sm:aspect-h-7 sm:aspect-w-16';
						} elseif ($g3_col == 3) {
							$col_class = 'sm:col-span-2';
						} elseif ($g3_col == 4) {
							$col_class = 'sm:col-span-4';
						} else {
							$col_class = '';
						}
						?>
			            <div class="<?= $col_class; ?>">
			                <img src="<?= $gallery_image; ?>" alt="" class="h-full w-full object-cover">
			            </div>
			            <?php $g3_col++; ?>
		        	<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>
