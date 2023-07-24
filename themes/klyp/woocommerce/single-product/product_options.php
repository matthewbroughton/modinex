<?php
$product_options_all_fields = get_field('product_option_repeater');
$product_attachment_1 = get_field('product_attachment_1');
$product_attachment_2 = get_field('product_attachment_2');
array_push($has_section, 'technical-info/Technical Info');
global $post;
$productDepValue = array();

//All dependencies option available from the backend
if (! empty($product_options_all_fields)) {
    $productDepValue = get_the_product_dependency_options($product_options_all_fields, $post->ID);
}

//Index value for start the filtering loop
$depValueIndex = 0;

/**
 * We should only get the available dependency option for the first option initially
 * From the list of avalaible dependency, we need to run through and filter only the available for the first option
 * So, the intialDepList is the filtered result of the productDepValue
 **/
$initalDepList = array();
foreach ($productDepValue as $depValue) {
    if ($depValueIndex > 0) {
        if ($depValue[array_key_first($depValue)] != $productDepValue[0][array_key_first($depValue)]){
            unset($productDepValue[$depValueIndex]);
            continue;
        }
        foreach ($depValue as $optionTypeKey => $depOptionValue) {
            //If value match the first productDepValue array index, save to $intitalDeplist
            //If we have a value that doesn't match with the first productDepVaue array, save it and do not continue with the rest
            $initalDepList[$depValueIndex][$optionTypeKey] = $depOptionValue;
            if ($depOptionValue != $productDepValue[0][$optionTypeKey]) {
                break;
            }
        }
    } else {
        $initalDepList[0] = $productDepValue[0];
    }
    $depValueIndex++;
}

if (! empty($productDepValue)) {
    $optionFlag = true;
}
?>

<input type="hidden" class="get_options_product_id" value='<?php echo $post->ID; ?>'>
<input type="hidden" id="page-permalink" value='<?php echo get_permalink(); ?>'>
<?php
if(count($product_options_all_fields) > 1):
foreach ($product_options_all_fields as $poKey => $product_option): ?>
    <?php
        $optionType = strtolower(str_replace(' ', '_', trim($product_option['product_option_type'])));
        $stepCounter = $poKey + 1;
        $optionTitle = ($product_option['product_option_type'] === 'Profile Option') ? ('Size') : ( $product_option['product_option_type']);
    ?>
    <div class="" data-option-type="<?php echo $optionType; ?>">
        <h3 class="text-3xl mt-12 mb-8">
            <?= 'Step '. $stepCounter . ': '; ?>
            <?= 'Select ' . $optionTitle; ?>
        </h3>
        <div class="section-des__product-description">
            <?= $product_option['product_option_description']; ?>
        </div>
        <div class="grid grid-cols-3 product-options-list gap-4" data-option-type="<?= $product_option['product_option_type']; ?>" data-option-key="<?php echo $poKey; ?>">
            <?php foreach ($product_option['product_option_value_repeater'] as $index => $option_value): ?>
                <?php
                    if ($poKey == 0) {
                        $startingOptionType = strtolower($product_option['product_option_type']);
                        $startingOptionValue = $productDepValue[0][$startingOptionType];
                    }

                    $optionValue = strtolower(str_replace(' ', '_', trim($option_value['product_option_value'])));

                    //First option selected, we should show the available option in the next step based on the product dependencies
                    $optionDisabled = '';

                    if ($poKey != 0) {
                        if (! in_array($optionValue, array_column($initalDepList, $optionType))) {
                            $optionDisabled = 'option-disabled';
                        }
                    }
                ?>
                <div class="product-option w-full max-w-full cursor-pointer relative <?php echo ($productDepValue[0][$optionType] == $optionValue) ? 'active' : ''; ?> <?php echo $optionDisabled; ?>"
                    data-product-new-image="<?php echo $option_value['product_option_product_image']; ?>" data-price-change="<?php echo $option_value['product_option_price']; ?>"
                    data-option-value="<?php echo $optionValue; ?>">
                    <div class="select-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                          <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <?php if ($option_value['product_option_image'] != false): ?>
                        <div class="aspect-h-1 aspect-w-1">
                            <img src="<?= $option_value['product_option_image']; ?>" class="w-full  h-full object-contain">
                        </div>
                    <?php endif; ?>

                    <h5 class="product-option-title p-2 sm:p-4">
                        <?= $option_value['product_option_value']; ?>
                    </h5>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php
endforeach;
endif;
?>

<?php
    if(count($product_options_all_fields) > 1):
    $finalStepCounter = count($product_options_all_fields) + 1;
?>
    <div class="form-inline my-2 my-lg-0 justify-content-start section-project-bottom-nav__btn">
        <h3 class="text-3xl mt-12 mb-8">Step <?= $finalStepCounter; ?>: Start Building Your Design</h3>
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="#" class="text-black border-black rounded-full border py-2 px-4 transition hover:text-white hover:bg-sage hover:border-sage section-project-bottom-nav__btn-form emailSpecs-form clickable_email" data-btn="emailSpecs-form">Email Me Specs</a>
            <a href="#" class="text-black border-black rounded-full border py-2 px-4 transition hover:text-white hover:bg-sage hover:border-sage section-project-bottom-nav__btn-form clickable_sample" data-btn="sample-form">Request Sample</a>
            <a href="#" class="text-black border-black rounded-full border py-2 px-4 transition hover:text-white hover:bg-sage hover:border-sage section-project-bottom-nav__btn-form clickable_quote" data-btn="quote-form">Request Quote </a>
        </div>
    </div>
<?php
    endif;
?>

<?php
    if (! empty($product_attachment_1)) {
        echo '<input id="product_attachment_1" type="hidden" class="product_attachment_1" value="' . $product_attachment_1 . '">';
    }

    if (! empty($product_attachment_2)) {
        echo '<input id="product_attachment_2" type="hidden" class="product_attachment_2" value="' . $product_attachment_2 . '">';
    }
?>