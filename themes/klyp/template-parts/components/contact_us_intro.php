<?php
//Settings
$section_show = get_sub_field('component_contact_us_intro_component_enabled');
$section_id = get_sub_field('component_contact_us_intro_field_id');
$section_class = get_sub_field('component_contact_us_intro_field_class');

//Contents
$title = get_sub_field('component_contact_us_intro_title');
$byline = get_sub_field('component_contact_us_intro_byline');
?>

<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> mn-section section-contact-head">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-intro__content">
                        <h2 class="mn-title--big text-center">
                            <?= $title; ?>
                        </h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="section-contact-head__content">
                            <?= $byline; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
