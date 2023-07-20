<style>
    .product-information-hub-section{
        padding: 5%;
        display: flex;
        justify-content: center;
        align-items: center;
        height: auto;
    }
    .pih-container{
        width: 55%;
        height: 100%;
    }
    .pih-series-container{
        margin: 5px 0;
        transition: all 0.3s ease-in-out;
    }
    .pih-series-container:hover{
        cursor: pointer;
    }
    .pih-series-name-container{
        background: #E7E7E7;
        padding: 3% 5%;
        position: relative;
    }
    .pih-series-name{
        font-size: 24px;
        color: #162131;
        margin:0;
    }
    .show-content ~ .pih-series-content-container{
        max-height: 1000px;
        visibility: visible;
        opacity: 1;
    }
    .pih-series-content-container{
        max-height: 0;
        visibility: hidden;
        opacity: 0;
        background: #F9F9F9;
        transition: all 0.7s ease-in-out;
    }
    .show-inner-content ~ .pih-product-name-content{
        max-height: 1000px;
        visibility: visible;
        opacity: 1;
    }
    .pih-product-name-content{
        max-height: 0;
        visibility: hidden;
        opacity: 0;
        transition: all 0.7s ease-in-out;
        margin: 0;
        
    }
    .pih-product-file-name{
        list-style-image: url('https://www.modinex.com.au/wp-content/uploads/2023/05/Group-269.png');
    }
    .youtube-link{
        list-style-image: url('https://www.modinex.com.au/wp-content/uploads/2023/05/Mask-Group-1.png');
    }
    .youtube-link::marker{
        display:inline-flex!important;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .pih-series-content{
        margin: 0;
        padding: 3% 0 3% 5%;
    }
    .pih-product-name-plus-icon-container{
        position: relative;
    }
    .pih-product-name{
        padding: 1% 0;
        color: #002B40;
        font-size: 16px;
        margin: 0;
        font-weight:500;
    }

    .pih-product-file-name,.youtube-link{
        padding: 0.5% 0.5%;
        color: #002B40;
        font-size: 16px;
        font-weight:200;
        text-decoration: underline;
    }


    /* OUTER PLUS ICON */
    .pih-plus-icon-container{
        position: absolute;
        right:0;
        top: 0;
        height: 100%;
        width: 10%;
        background: #DBDBDB;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.7s ease-in-out;
    }

    .plus-icon {
        position: relative;
        width: 20px;
        height: 20px;
    }

    .horizontal-line,
    .vertical-line {
        position: absolute;
        background-color: black;
    }

    .horizontal-line {
        width: 100%;
        height: 2px;
        top: 50%;
        transform: translateY(-50%);
    }

    .vertical-line {
        width: 2px;
        height: 100%;
        left: 50%;
        transform: translateX(-50%) rotate(0deg);
        transition: all 0.4s ease-in-out;
    }
    .show-content  .pih-plus-icon-container{
        background: #C6C4C4;
    }
    .show-content  .vertical-line{
        transform: translateX(-50%) rotate(90deg);
    }



    /* INNER PLUS ICON */
    .pih-plus-icon-container-inner{
        position: absolute;
        right:0;
        top: 0;
        height: 100%;
        width: 10%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.7s ease-in-out;
    }

    .plus-icon-inner {
        position: relative;
        width: 10px;
        height: 10px;
    }

    .horizontal-line-inner,
    .vertical-line-inner {
        position: absolute;
        background-color: black;
    }

    .horizontal-line-inner {
        width: 100%;
        height: 2px;
        top: 50%;
        transform: translateY(-50%);
    }

    .vertical-line-inner {
        width: 2px;
        height: 100%;
        left: 50%;
        transform: translateX(-50%) rotate(0deg);
        transition: all 0.4s ease-in-out;
    }
    .show-inner-content .vertical-line-inner{
        transform: translateX(-50%) rotate(90deg);
    }
    .collapsible,.inner-collapsible{
        overflow: hidden;
    }

    
    @media only screen and (max-device-width: 701px) {
        .section-br-banner__content{
            position: relative!important;
        }
        .pih-container{
            width: 100%;
        }
        .pih-plus-icon-container,.pih-plus-icon-container-inner{
            width:15%;
        }
        .pih-series-name{
            font-size: 18px;
        }
        .pih-product-name,.pih-product-file-name{
            font-size: 14px;
        }
        .plus-icon {
        width: 15px;
        height: 15px;
        }
    }

    /* Tablet Screen Size */

    @media only screen and (min-width: 702px) and (max-width: 1019px) {
        .pih-container{
            width: 100%;
        }
        .pih-series-name{
            font-size: 20px;
        }
        .pih-product-name,.pih-product-file-name{
            font-size: 14px;
        }
        .plus-icon {
        width: 15px;
        height: 15px;
        }
    }


    /* Macbook Air Screen Size */

    @media only screen and (min-width: 1020px) and (max-width: 1300px) {
        .pih-container{
            width: 65%;
        }
        .pih-series-name{
            font-size: 20px;
        }
        .pih-product-name,.pih-product-file-name{
            font-size: 14px;
        }
        .plus-icon {
        width: 15px;
        height: 15px;
        }
    }


    /* Small Laptop Size */

    @media only screen and (min-width: 1301px) and (max-width: 1800px) {
        .pih-container{
            width: 65%;
        }
        .pih-series-name{
            font-size: 20px;
        }
        .pih-product-name,.pih-product-file-name{
            font-size: 14px;
        }
        .plus-icon {
        width: 15px;
        height: 15px;
        }
    }


    /* Widescreen Size */

    @media only screen and (min-width: 1801px) and (max-width: 2050px) {}


    /* Imac Screen Size */

    @media only screen and (min-width: 2051px) and (max-width: 2305px) {}

</style>


<section class="product-information-hub-section">
    <div class="pih-container">
        <?php 
            if(have_rows('modinex_series')):
                while(have_rows('modinex_series')):the_row();
                $seriesName = get_sub_field('series_name');
                if(have_rows('series_group')):
                    while(have_rows('series_group')):the_row();
        ?>
        <div class="pih-series-container">
            <div class="pih-series-name-container collapsible">
                <h2 class="pih-series-name"><?php echo $seriesName; ?></h2>
                <div class="pih-plus-icon-container">
                    <div class="plus-icon">
                        <div class="horizontal-line"></div>
                        <div class="vertical-line"></div>
                    </div>
                </div>
            </div>
            
            <div class="pih-series-content-container">
                <div class="pih-series-content">
                    <?php
                    if(have_rows('product_repeater')):
                        while(have_rows('product_repeater')):the_row();
                        $productName = get_sub_field('product_name');
                        $productYoutube = get_sub_field('product_youtube_tutorial');
                    ?>
                    <div class="pih-product-name-container ">
                        <div class="pih-product-name-plus-icon-container inner-collapsible">
                            <h2 class = "pih-product-name"> <?php echo $productName; ?> </h2>
                            <div class="pih-plus-icon-container-inner">
                                <div class="plus-icon-inner">
                                    <div class="horizontal-line-inner"></div>
                                    <div class="vertical-line-inner"></div>
                                </div>
                            </div>
                        </div>
                        <ul class="pih-product-name-content">
                            <?php
                             if(have_rows('product_download_repeater')):
                                while(have_rows('product_download_repeater')):the_row();
                                if(have_rows('download_file_group')):
                                    while(have_rows('download_file_group')):the_row();
                                    $downloadText = get_sub_field('download_text');
                                    $downloadFile = get_sub_field('download_file');
                            ?>
                            <a href="<?php echo $downloadFile?>" class = "product-link" target="_blank">
                                <li class="pih-product-file-name"><?php echo $downloadText?></li>
                            </a>
                            <?php
                                    endwhile;
                                endif;
                                endwhile;
                            endif;
                            ?>
                            <?php
                                if($productYoutube){
                                    ?>
                                    
                                        <a class="youtube-link-container" href="<?php echo $productYoutube;?>" target="_blank">
                                            <li class="youtube-link">
                                                <?php echo $productName.'  Video Guide';?>
                                            </li>
                                        </a>
                           
                                    <?php
                                }
                                else{

                                }
                            ?>
                            
                        </ul>
                    </div>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <?php
                    endwhile;
                endif;
            endwhile;
        endif;
        ?>

    </div>
</section>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        
        jQuery('.collapsible').on("click",function(e) {
        
            e.stopPropagation();
            jQuery(this).toggleClass('show-content');

        });
           // CLOSE CONTAINER WHEN IT IS CLICKED





    jQuery('.inner-collapsible').on("click",function(e) {
        
        e.stopPropagation();
        jQuery(this).toggleClass('show-inner-content');
    });


    // jQuery(document).click(function() {
    //   if (jQuery('.collapsible').hasClass('show-content')) {
    //       jQuery(".collapsible").removeClass('show-content');
    //   }
   
    // });
    // if(('.inner-collapsible'))
        

    });
</script>
