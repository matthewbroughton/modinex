<?php
	//Settings as General Component
	$section_show = get_sub_field('component_gallery_tabs_component_enabled');
	$section_id = get_sub_field('component_gallery_tabs_field_id');
	$section_class = get_sub_field('component_gallery_tabs_field_class');

	//Contents
	$title = get_sub_field('component_gallery_tabs_title');

	$feature_cta_enabled    = get_sub_field('component_gallery_tabs_cta_enabled');
	$feature_cta_url        = get_sub_field('component_gallery_tabs_cta_url');
?>

<?php if ($section_show == true) : ?>
	<section id="<?= $section_id; ?>" class="<?= $section_class; ?> border-x border-black mx-4 sm:mx-6 pt-8 sm:pt-16">
		<div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
			<?php if( have_rows('component_gallery_tabs_tabs_repeater') ):
			   $i = 1;
			   $uniqueId = uniqid();
			?>
				<div class="tabs">
					<div class="grid lg:grid-cols-[max-content_minmax(0,_1fr)] ">
						<div class="pt-8 md:pt-12 md:pr-12 pb-8 sm:pb-16">
							<?php if($title): ?>
								<h4 id="tablist-title" class="text-3xl mb-6"><?= $title ?></h4>
							<?php endif; ?>

							<div class="automatic flex flex-col justify-start gap-2" role="tablist" aria-labelledby="tablist-title">
								<?php
									while ( have_rows('component_gallery_tabs_tabs_repeater') ) : the_row();
										$header = get_sub_field('component_gallery_tabs_tabs_repeater_title');
										$content = get_sub_field('component_gallery_tabs_tabs_repeater_content');
								?>

								<button id="tab-<?php echo $uniqueId?>-<?php echo $i; ?>" class="before:content-['–'] text-left focus-visible:ring-2 ring-offset-1 focus-visible:outline-0 <?=$i === 1 ? 'text-black' : 'text-gray-400'?>" type="button" role="tab" aria-selected="true" aria-controls="tabpanel-<?php echo $uniqueId?>-<?php echo $i; ?>">
								  <?= $header ?>
								</button>

								<?php
										$i++;
									endwhile; //End the loop
								?>
							</div>

							<?php if ($feature_cta_enabled == true) : ?>
								<a class="flex self-start justify-start items-center gap-2 text-black mt-4" href="<?= $feature_cta_url['url']; ?>"><span><?= $feature_cta_url['title']; ?></span> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" /></svg></a>
							<?php endif; ?>
						</div>
						<div class="pt-8 md:pt-12 md:pl-24 pb-8 sm:pb-16 md:pb-32">
							<?php
								$i = 1;
								while ( have_rows('component_gallery_tabs_tabs_repeater') ) : the_row();
									$gallery = get_sub_field('component_gallery_tabs_tabs_repeater_gallery');
									$size = 'full'; // (thumbnail, medium, large, full or custom size)
							?>

							<div id="tabpanel-<?php echo $uniqueId?>-<?php echo $i ?>" role="tabpanel" tabindex="0" aria-labelledby="tab-<?php echo $uniqueId?>-<?php echo $i ?>" class="<?=$i != 1 ? 'is-hidden' : ''?>">
								<div class="main-carousel">
									<?php foreach( $gallery as $gallery_id ): ?>
										<div class="carousel-cell mr-4 w-full h-[31.25rem]">
											<img class="h-full w-full object-contain object-center" src="<?php echo esc_url($gallery_id['url']); ?>" alt="<?php echo esc_attr($gallery_id['alt']); ?>" />
										</div>
									<?php endforeach; ?>
								</div>
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
	<!-- <script>
		/*
		 *   This content is licensed according to the W3C Software License at
		 *   https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
		 *
		 *   File:   tabs-automatic.js
		 *
		 *   Desc:   Tablist widget that implements ARIA Authoring Practices
		 */

		'use strict';

		class TabsAutomatic {
		  constructor(groupNode) {
			this.tablistNode = groupNode;

			this.tabs = [];

			this.firstTab = null;
			this.lastTab = null;

			this.tabs = Array.from(this.tablistNode.querySelectorAll('[role=tab]'));
			this.tabpanels = [];

			for (var i = 0; i < this.tabs.length; i += 1) {
			  var tab = this.tabs[i];
			  var tabpanel = document.getElementById(tab.getAttribute('aria-controls'));

			  tab.tabIndex = -1;
			  tab.setAttribute('aria-selected', 'false');
			  this.tabpanels.push(tabpanel);

			  tab.addEventListener('keydown', this.onKeydown.bind(this));
			  tab.addEventListener('click', this.onClick.bind(this));

			  if (!this.firstTab) {
				this.firstTab = tab;
			  }
			  this.lastTab = tab;
			}

			this.setSelectedTab(this.firstTab, false);
		  }

		  setSelectedTab(currentTab, setFocus) {
			if (typeof setFocus !== 'boolean') {
			  setFocus = true;
			}
			for (var i = 0; i < this.tabs.length; i += 1) {
			  var tab = this.tabs[i];
			  if (currentTab === tab) {
				tab.setAttribute('aria-selected', 'true');
				tab.removeAttribute('tabindex');
				tab.classList.add('text-black');
				this.tabpanels[i].classList.remove('is-hidden');
				if (setFocus) {
				  tab.focus();
				}
			  } else {
				tab.setAttribute('aria-selected', 'false');
				tab.tabIndex = -1;
				tab.classList.remove('text-black');
				this.tabpanels[i].classList.add('is-hidden');
			  }
			}
		  }

		  setSelectedToPreviousTab(currentTab) {
			var index;

			if (currentTab === this.firstTab) {
			  this.setSelectedTab(this.lastTab);
			} else {
			  index = this.tabs.indexOf(currentTab);
			  this.setSelectedTab(this.tabs[index - 1]);
			}
		  }

		  setSelectedToNextTab(currentTab) {
			var index;

			if (currentTab === this.lastTab) {
			  this.setSelectedTab(this.firstTab);
			} else {
			  index = this.tabs.indexOf(currentTab);
			  this.setSelectedTab(this.tabs[index + 1]);
			}
		  }

		  /* EVENT HANDLERS */

		  onKeydown(event) {
			var tgt = event.currentTarget,
			  flag = false;

			switch (event.key) {
			  case 'ArrowUp':
				this.setSelectedToPreviousTab(tgt);
				flag = true;
				break;

			  case 'ArrowDown':
				this.setSelectedToNextTab(tgt);
				flag = true;
				break;

			  case 'Home':
				this.setSelectedTab(this.firstTab);
				flag = true;
				break;

			  case 'End':
				this.setSelectedTab(this.lastTab);
				flag = true;
				break;

			  default:
				break;
			}

			if (flag) {
			  event.stopPropagation();
			  event.preventDefault();
			}
		  }

		  onClick(event) {
			this.setSelectedTab(event.currentTarget);
		  }
		}

		// Initialize tablist

		window.addEventListener('load', function () {
		  var tablists = document.querySelectorAll('[role=tablist].automatic');
		  for (var i = 0; i < tablists.length; i++) {
			new TabsAutomatic(tablists[i]);
		  }
		});
	</script> -->
<?php endif; ?>