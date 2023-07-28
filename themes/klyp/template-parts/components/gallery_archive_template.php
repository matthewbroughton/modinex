<div class="section-product-list__masonry-item section-gallery-list__masonry-item pl-8 mb-8 w-full max-w-full md:max-w-[50%] lg:max-w-[33%]" data-maxpage="<?= ($maxPageNumber); ?>">
     <div class="position-relative">
         <a href="<?php echo $gallery_image_url; ?>" class="mn-product-pop-btn">
             <img src="<?= $gallery_image_url; ?>" class="img-fluid">
         </a>
         <div class="section-product-list__masonry-txt mt-4">
             <h2 class="section-product-list__masonry-title">
                 <a href="<?= $gallery_link; ?>" target="_blank" class="flex justify-between">
                     <?= $gallery_title; ?>
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 flex-shrink-0"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" /></svg>
                 </a>
             </h2>
         </div>
     </div>
 </div>