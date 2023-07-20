<?php
//Settings
$section_show           = get_sub_field('component_contact_us_section_component_enabled');
$section_id             = get_sub_field('component_contact_us_section_field_id');
$section_class          = get_sub_field('component_contact_us_section_field_class');

//Contents
$all_contact_locations           = get_sub_field('contact_locations_repeater');
$contact_section_title           = get_sub_field('contact_section_title');
$contact_section_description     = get_sub_field('contact_section_description');
$contact_section_phone           = get_sub_field('contact_section_phone');
$contact_section_email           = get_sub_field('contact_section_email');
$contact_form_title              = get_sub_field('contact_form_title');
$contact_form_shortcode          = get_sub_field('contact_form_shortcode');

$current_page = get_queried_object()->post_name;

?>
<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> border-x border-black mx-4 sm:mx-6 bg-gray-50">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full">
            <div class="grid grid-cols-1 md:grid-cols-2 divide-black divide-y md:divide-y-0 md:divide-x">
                <div class="flex flex-col p-6 py-16 sm:p-16 sm:pr-14 sm:pt-24">
                    <div>
                        <h3 class="text-3xl lg:text-4xl mb-4"><?= $contact_section_title; ?></h3>
                        <?= $contact_section_description; ?>
                    </div>
                    <hr class="my-16 border-black">
                    <div class="grid lg:grid-cols-2 gap-4 mb-8">
                        <?php if ($current_page != 'contact-us') { ?>
                            <div class="flex flex-col">
                            <?php if ($contact_section_phone) : ?>
                            <div>
                                P&mdash;<a href="tel:<?= $contact_section_phone; ?>"><?= $contact_section_phone; ?></a>
                            </div>
                            <?php endif; ?>
                            <?php if ($contact_section_email) : ?>
                            <div>
                                E&mdash;<a href="mailto:<?= $contact_section_email; ?>"><?= $contact_section_email; ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php } ?>
                        <div class="<?php $current_page != 'contact-us' ? 'sm:pl-4' : '' ?> flex gap-2 justify-start items-center">
                            <?php if (get_field('linkedin_profile', 'option')) : ?>
                                    <a href="<?= get_field('linkedin_profile', 'option'); ?>" class="invert opacity-50 transition hover:opacity-80 w-8">
                                        <img class="w-full object-contain" src="<?= get_template_directory_uri() . '/assets/dist/img/linkedin.png'; ?>" alt="">
                                    </a>

                            <?php endif; ?>
                            <?php if (get_field('facebook_profile', 'option')) : ?>
                                    <a href="<?= get_field('facebook_profile', 'option'); ?>" class="invert opacity-50 transition hover:opacity-80 w-8">
                                        <img class="w-full object-contain" src="<?= get_template_directory_uri() . '/assets/dist/img/facebook.png'; ?>" alt="">
                                    </a>
                            <?php endif; ?>
                            <?php if (get_field('houzz_profile', 'option')) : ?>
                                    <a href="<?= get_field('houzz_profile', 'option'); ?>" class="invert opacity-50 transition hover:opacity-80 w-8">
                                        <img class="w-full object-contain" src="<?= get_template_directory_uri() . '/assets/dist/img/houzz.png'; ?>" alt="">
                                    </a>
                            <?php endif; ?>
                            <?php if (get_field('pinterest_profile', 'option')) : ?>
                                    <a href="<?= get_field('pinterest_profile', 'option'); ?>" class="invert opacity-50 transition hover:opacity-80 w-8">
                                        <img class="w-full object-contain" src="<?= get_template_directory_uri() . '/assets/dist/img/pinterest.png'; ?>" alt="">
                                    </a>
                            <?php endif; ?>
                            <?php if(get_field('instagram_profile', 'option')) : ?>
                                    <a href="<?= get_field('instagram_profile', 'option'); ?>" class="invert opacity-50 transition hover:opacity-80 w-8">
                                        <img class="w-full object-contain" src="<?= get_template_directory_uri() . '/assets/dist/img/instagram.png'; ?>" alt="">
                                    </a>
                            <?php endif; ?>
                            <?php if (get_field('youtube_profile', 'option')) : ?>
                                    <a href="<?= get_field('youtube_profile', 'option'); ?>" class="invert opacity-50 transition hover:opacity-80 w-8">
                                        <img class="w-full object-contain" src="<?= get_template_directory_uri() . '/assets/dist/img/youtube.png'; ?>" alt="">
                                    </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if( have_rows('contact_locations_repeater') ): ?>
                        <div class="grid grid-cols-2 gap-x-4">
                            <?php foreach ($all_contact_locations as $contact_location) : ?>
                                <div class="pb-8 even:pl-4 even:border-l even:border-black">
                                    <h4 class="mb-1"><?= $contact_location['contact_location_title']; ?></h4>
                                    <div class="mb-4"><?= $contact_location['contact_location_address']; ?></div>
                                    <?php if ($current_page == 'contact-us'): ?>
                                        <div class="flex flex-col gap-2">
                                            <?php if ($contact_location['contact_location_phone']) : ?>
                                                <div class="flex gap-2 relative">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                      <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z" clip-rule="evenodd" />
                                                    </svg>
                                                    <a href="tel:<?= $contact_location['contact_location_phone']; ?>" class="">
                                                        <?= $contact_location['contact_location_phone']; ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($contact_location['contact_location_email']) : ?>
                                                <div class="flex gap-2 relative">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                      <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                                      <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                                                    </svg>

                                                    <a href="mailto:<?= $contact_location['contact_location_email']; ?>" class="">
                                                        <?= $contact_location['contact_location_email']; ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($contact_location['contact_location_direction_link']) : ?>
                                                <div class="flex gap-2 relative">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                      <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd" />
                                                    </svg>
                                                    <a href="<?= $contact_location['contact_location_direction_link']; ?>" class="">
                                                        Get Directions
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="p-6 py-16 sm:p-16 sm:pl-14 sm:pt-24">
                    <h3 class="text-3xl lg:text-4xl mb-4"><?= $contact_form_title; ?></h3>
                    <?= do_shortcode($contact_form_shortcode); ?>
                </div>
            </div>
        </div>

    </section>
<?php endif; ?>
