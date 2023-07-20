<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Klyp
 */
$current_page = get_queried_object()->post_name;
?>
    </div><!-- #content -->
    <footer id="colophon" class="bg-white border-t border-black">
        <div class="border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36">
            <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-4 sm:px-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <a href="<?= get_home_url(); ?>">
                        <img src="<?= get_field('footer_logo', 'option'); ?>" alt="" class="w-72">
                    </a>
                    <p>
                        Bespoke timber &ndash; Architectural Signatures
                    </p>
                </div>
                <hr class="border-black my-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 divide-y sm:divide-y-0 sm:divide-x sm:divide-black">
                    <?php
                    if (is_active_sidebar('footer-menu-selection')) {
                        dynamic_sidebar('footer-menu-selection');
                    }
                    ?>

                    <div class="pt-4 sm:pt-0 sm:pl-12">
                        <h4 class="font-bold mb-4">
                            Head Office
                        </h4>
                        <address>
                            Springfield Tower <br>
                            Level 7/145 Sinnathamby Blvd <br>
                            Springfield Central QLD 4300
                        </address>
                    </div>
                    <div class="pt-4 sm:pt-0 sm:pl-12">
                        <h4 class="font-bold mb-4">
                            Contact
                        </h4>
                        <div class="mb-4">
                            <?php if (get_field('site_phone_number', 'option')) : ?>
                            <div>
                                P&mdash;<a href="tel:<?php echo get_field('site_phone_number', 'option') ?>"><?php echo get_field('site_phone_number', 'option') ?></a>
                            </div>
                            <?php endif ?>
                            <?php if (get_field('site_email', 'option')) : ?>
                            <div>
                                E&mdash;<a href="mailto:<?php echo get_field('site_email', 'option') ?>"><?php echo get_field('site_email', 'option') ?></a>
                            </div>
                            <?php endif ?>
                        </div>
                        <div class="grid auto-cols-auto grid-flow-col gap-2 justify-start items-center">
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
                </div>
            </div>
        </div>
        <div id="copyright-information" class="border-t border-black py-6">
            <div class="flex flex-col sm:flex-row justify-center items-center gap-2 text-sm">
                <div class="text-center"> Copyright <?php echo date('Y');?> Modinex | Brand by <a href="mailto:studio@gridsandglyphs.com">Grids+Glyphs</a> | Website by <a href="https://gordondigital.com.au">Gordon Digital</a></div>
                <?php
                if (is_active_sidebar('footer-copyright-menu-selection')) {
                    dynamic_sidebar('footer-copyright-menu-selection');
                }
                ?>
            </div>
        </div>


    </footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
