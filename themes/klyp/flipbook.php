<!-- Template Name: Flipbook 
--->
<?php
get_header();
?>
    <div class="flipbook-container">
        <?php
         if( have_rows('flipbook_pdf_repeater') ): while( have_rows('flipbook_pdf_repeater') ): the_row(); 
             $pdf = get_sub_field('flipbook_pdf');
             echo $pdf;
        ?>

          <?php endwhile;  endif;?>
    </div>

<?php
get_footer();
?>