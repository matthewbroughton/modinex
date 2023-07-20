<?php
//Settings
$section_show           = get_sub_field('component_sidebyside_texts_component_enabled');
$section_id             = get_sub_field('component_sidebyside_texts_field_id');
$section_class          = get_sub_field('component_sidebyside_texts_field_class');

$blocks                 = get_sub_field('component_sidebyside_texts_blocks');
?>
<?php if ($section_show == true) : ?>
    <section id="<?= $section_id; ?>" class="<?= $section_class; ?> mn-section section-intro section-general-title-list">
        <div class="container">
            <?php foreach ($blocks as $key => $block) : ?>
            <div class="row">
                <div class="col-12">
                    <div class="section-general-list-wrap">
                        <div class="row">
                            <div class="col-12 <?= count($blocks) == 2 ? 'col-md-6' : ''; ?>">
                                <h3 class="mn-sub-title">
                                    <?= $block['title']; ?>
                                </h3>
                                <?php if (isset($block['lists'])) : ?>
                                <ul class="section-general-list">
                                    <?php foreach ($block['lists'] as $key => $list) : ?>
                                    <li class="section-general-list__item">
                                        <span class="section-general-list__title">
                                            <?= $list['title']; ?>
                                        </span>
                                        <span class="section-general-list__content">
                                            <?= $list['description']; ?>
                                        </span>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>