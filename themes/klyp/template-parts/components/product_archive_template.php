<div>
    <a href="<?= $product_link; ?>">
        <div class="aspect-w-1 aspect-h-1">
            <img src="<?= $product_image_url; ?>" alt="" class="img-fluid">
        </div>
        <a class="flex justify-between items-start gap-2 text-black mt-4" href="<?= $product_link; ?>">
            <span class="capitalize"><?= $product_title ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 flex-shrink-0"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" /></svg>
        </a>
    </a>
    <?php if ($i == 0 && $paged == 1) { ?>
        <input type="hidden" id="product_pagemax" data-maxpage="<?php echo $maxPageNumber ?>">
    <?php } ?>
</div>
