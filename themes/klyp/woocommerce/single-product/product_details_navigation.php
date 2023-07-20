<?php
$menuOutput = '';
foreach ($has_section as $section) {
    $section_split = explode('/', $section);
    $menuOutput .= '<li class="nav-item"><a href="#' . $section_split[0] . '" class="nav-link" data-toggle="tab">' . $section_split[1] . '</a></li>';
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-bottom section-project-bottom-nav">
    <div class="container-fluid">
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 d-none d-xxl-flex">
                <?= $menuOutput; ?>
            </ul>
            <div class="form-inline my-2 my-lg-0 justify-content-center section-project-bottom-nav__btn">
                <?php if (get_field('email_me_specs_shortcode', 'option') != '') : ?>
                    <a href="#" class="mn-btn mn-btn--fill mr-sm-2 section-project-bottom-nav__btn-form emailSpecs-form" data-btn="emailSpecs-form">
                        Email Me Specs
                    </a>
                <?php endif; ?>
                <?php if (get_field('request_sample_form_shortcode', 'option') != '') : ?>
                    <a href="#" class="mn-btn mn-btn--fill mr-sm-2 section-project-bottom-nav__btn-form" data-btn="sample-form">
                        request sample
                    </a>
                <?php endif; ?>
                <?php if (get_field('request_quote_form_shortcode', 'option') != '') : ?>
                    <a href="#" class="mn-btn mn-btn--fill section-project-bottom-nav__btn-form" data-btn="quote-form">
                        request quote
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
