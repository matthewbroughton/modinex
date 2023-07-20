<?php
    //Settings
    $section_show     = get_field('product_details_downloads')['enable_mobile'];
    $section_id       = get_field('product_details_downloads')['id'] ? get_field('product_details_downloads')['id'] : 'product-downloads';
    $section_class    = get_field('product_details_downloads')['class'];

    //Contents
    $download_html      = '';
    $downloads          = get_field('product_details_downloads')['pd_component_downloads_lists'];

    if ($downloads) {
        foreach ($downloads as $download) {
            $download_html .= '<div class="p-4 border">
                                    <a href="' . $download['download_item']['url'] . '" class="flex flex-col gap-2 h-full justify-center" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mb-2">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                        <h4 class="text-lg">
                                            <span class="d-block">Download</span> ' . $download['download_text'] . '
                                        </h4>
                                    </a>
                                </div>';
        }
    }
?>
<?php if ($section_show == true && $download_html) : ?>
    <section class="bg-white border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36 section-combine <?= $section_class; ?>" id="<?= $section_id; ?>">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8">
            <div class="grid lg:grid-cols-12 divide-y lg:divide-y-0 lg:divide-x divide-black gap-8">
                <h2 class="text-3xl lg:col-span-4">
                    Downloads & Compliance
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 pt-8 lg:pt-0 lg:pl-12 lg:col-span-8">
                    <?= $download_html; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
        array_push($has_section, $section_id . '/Downloads & Compliance');
    ?>
<?php endif; ?>
