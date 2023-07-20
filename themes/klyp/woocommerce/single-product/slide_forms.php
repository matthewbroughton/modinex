<!--=====================================
=            Slide Form Section         =
======================================-->
<?php if (get_field('email_me_specs_shortcode', 'option') != '') : ?>
    <section class="section-side-form section-side-form--emailSpecs" data-form="emailSpecs-form">
        <div class="section-side-form__wrap position-relative">
            <h2 class="text-3xl">
                Receive tech specs
            </h2>
            <?= do_shortcode(get_field('email_me_specs_shortcode', 'option')); ?>
            <span class="section-side-form__close absolute top-4 right-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
        </div>
    </section>
<?php endif; ?>

<?php if (get_field('request_sample_form_shortcode', 'option') != '') : ?>
    <section class="section-side-form section-side-form--sample" data-form="sample-form">
        <div class="section-side-form__wrap position-relative">
            <h2 class="text-3xl">
                Request a sample
            </h2>
            <table class="selected_options_table">
                <thead></thead>
                <tbody></tbody>
            </table>
            <?= do_shortcode(get_field('request_sample_form_shortcode', 'option')); ?>
            <span class="section-side-form__close absolute top-4 right-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
        </div>
    </section>
<?php endif; ?>

<?php if (get_field('request_quote_form_shortcode', 'option') != '') : ?>
    <section class="section-side-form section-side-form--quote" data-form="quote-form">
        <div class="section-side-form__wrap position-relative">
            <h2 class="text-3xl">
                Request a quote
            </h2>
            <table class="selected_options_table">
                <thead></thead>
                <tbody></tbody>
            </table>
            <?= do_shortcode(get_field('request_quote_form_shortcode', 'option')); ?>
            <span class="section-side-form__close absolute top-4 right-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
        </div>
    </section>
<?php endif; ?>
<div class="section-side-form-overlay"></div>
<!--====  End of Slide Form Section  ====-->