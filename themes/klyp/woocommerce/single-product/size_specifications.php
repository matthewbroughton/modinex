<?php
    //Settings
    $section_show                     = get_field('product_details_size_specifications')['enable_mobile'];
    $section_id                       = get_field('product_details_size_specifications')['id'] ? get_field('product_details_size_specifications')['id'] : 'size-specification';
    $section_class                    = get_field('product_details_size_specifications')['class'];

    //Contents

    $table_td                         = '';
    $size_specifications              = get_field('product_details_size_specifications')['pd_size_specifications'];
?>

<?php if ($section_show == true) :
    foreach ($size_specifications as $size_specification) {
        $table_th  = '';
        $table_td .= '<tr>';
        foreach ($size_specification as $key => $value) {
            $table_th .= '<th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">' . get_field_object($key)['label'] . '</th>';
            $table_td .= '<td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium">' . $value . '</td>';
        }
        $table_td .= '</tr>';
    }
?>
    <section class="bg-white border-x border-black mx-4 sm:mx-6 py-16 sm:py-24 lg:py-36 section-combine <?= $section_class; ?>" id="<?= $section_id; ?>">
        <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-4 sm:px-8">
            <h2 class="text-3xl mb-8">Size & Specifications</h2>
            <div class="w-full overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <?= $table_th; ?>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?= $table_td; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <?php
        array_push($has_section, $section_id . '/Size & Specifications');
    ?>
<?php endif; ?>
