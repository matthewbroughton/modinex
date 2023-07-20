<?php

    $component              = get_field('post_attributes_similar');
    //Settings
    $section_id             = $component['id'];
    $section_class          = $component['class'];
    
    //Contents
    $default_list           = $component['post_attributes_layout_switch'];

    if ($default_list == true) {
        $query = new WP_Query(array(
            'orderby'           => 'rand',
            'post_status'       => 'publish',
            'post_type'         => 'post',
            'posts_per_page'    => 3,
            'post__not_in'      => array(get_the_ID()),
        ));
        $posts = $query->posts;
    } else {
        $posts = $component['post_attributes_lists'];
    }
?>

<?php if ($posts) : ?>
<section id="<?= $section_id; ?>" class="<?= $section_class; ?> mn-section pt-0 section-selling section-similar section-similar--post position-relative">
    <div class="container">
        <div class="row align-items-center section-similar__title">
            <div class="col-12 col-md-6">
                <h2 class="mn-title--big m-0">
                    Similar Posts
                </h2>
            </div>
        </div>
        <div class="row align-items-start">
            <?php foreach ($posts as $key => $post) : ?>
            <div class="col-lg-4 col-md-6">
                <div class="section-selling__img">
                    <div class="overflow-hidden">
                        <img src="<?= get_the_post_thumbnail_url((isset($post->ID) ? $post->ID : $post['post']->ID)); ?>" alt="<?= (isset($post->post_title) ? $post->post_title : $post['post']->post_title); ?>" class="img-fluid mn-scale-img">
                    </div>
                </div>
                <div class="section-selling__content position-relative">
                    <p class="section-similar__time--post">
                        Published <?= get_the_date('', (isset($post->ID) ? $post->ID : $post['post']->ID)); ?> 
                    </p>
                    <h2 class="mn-title section-similar__heading section-similar__heading--post"><?= (isset($post->post_title) ? $post->post_title : $post['post']->post_title); ?></h2>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
