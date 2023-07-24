<div class="flex flex-col gap-4">
    <?php if ($blogs_image_url) : ?>
        <a class="flex flex-col" href="<?= $blogs_link; ?>">
            <div class="aspect-w-4 aspect-h-3">
                <img src="<?= $blogs_image_url; ?>" alt="" class="w-full h-full object-cover">
            </div>
        </a>
    <?php endif; ?>
    <div class="flex flex-col">
        <div class="text-sm text-gray-600 mb-1">
            Published
            <time datetime="<?= get_the_date('Y-m-d', get_the_ID()); ?>" class="section-blog-list__time">
                <?= get_the_date('', get_the_ID()); ?>
            </time>
        </div>
        <h3 class="text-lg">
            <a href="<?= $blogs_link; ?>">
                <?= $blogs_title; ?>
            </a>
        </h3>
    </div>
</div>