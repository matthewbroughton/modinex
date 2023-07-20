<?php
    //Settings
    $section_show             = get_sub_field('component_projects_showcase_component_enabled');
    $section_id               = get_sub_field('component_projects_showcase_field_id');
    $section_class            = get_sub_field('component_projects_showcase_field_class');
    
    //Contents
    $section_title            = get_sub_field('component_projects_showcase_title');
    $section_description      = get_sub_field('component_projects_showcase_feature_description');
    $section_first_cta_text   = get_sub_field('component_project_showcase_firstbtn_text');
    $section_first_cta        = get_sub_field('component_project_showcase_firstbtn_url');
    $section_second_cta_text  = get_sub_field('component_project_showcase_secondbtn_text');
    $section_second_cta       = get_sub_field('component_project_showcase_secondbtn_url');
    $column_repeater          = get_sub_field('component_projects_showcase_repeater');
    $feature_image            = array();
    
    foreach ($column_repeater as $index => $column) {
        $feature_image[$index] = $column['feature_image'] == true ? $column['feature_image'] : get_template_directory_uri() . '/assets/dist/img/default.jpg';    
    }
?>
<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> mn-section mn-rpro section-project">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-12 position-static">
                    <div class="section-project__con">
                        <h2 class="section-project__title mn-title--big">
                            <?= $section_title; ?>
                        </h2>
                        <div class="section-project__text">
                            <?= $section_description; ?>
                        </div>
                        <div class="section-project__btn-grp">
                            <a href="<?= $section_first_cta; ?>" class="mn-btn mn-btn--fill">
                                <?= $section_first_cta_text; ?>
                            </a>
                            <a href="<?= $section_second_cta; ?>" class="mn-btn">
                                <?= $section_second_cta_text; ?>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="col-lg-7 col-12">
                    <div class="section-project__gallery">
                        <ul class="section-project__gallery-top">
                            <li class="section-project__gallery-top-s-item position-relative">
                                <div class="overflow-hidden">
                                    <img src="<?= $feature_image[0]; ?>" alt="" class="img-fluid mn-scale-img">
                                </div>
                            </li>
                            <li class="section-project__gallery-top-l-item">
                                <div class="overflow-hidden">
                                    <img src="<?= $feature_image[1]; ?>" alt="" class="img-fluid mn-scale-img">
                                </div>
                            </li>
                        </ul>
                        <ul class="section-project__gallery-bottom d-sm-none d-md-flex d-none">
                            <li class="section-project__gallery-bottom-l-item">
                                <div class="overflow-hidden">
                                    <img src="<?= $feature_image[2]; ?>" alt="" class="img-fluid mn-scale-img">
                                </div>
                            </li>
                            <li class="section-project__gallery-bottom-s-item">
                                <div class="overflow-hidden">
                                    <img src="<?= $feature_image[3]; ?>" alt="" class="img-fluid mn-scale-img">
                                </div>
                                <div class="overflow-hidden">
                                    <img src="<?= $feature_image[4]; ?>" alt="" class="img-fluid mn-scale-img">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>