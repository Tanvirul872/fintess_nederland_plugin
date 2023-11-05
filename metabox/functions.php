<?php

//metabox for fitnesspage

function metabox_fitnesspage(array $product_meta)
{

    $product_meta[] = array(
        'id'          => 'fitness-showroom',
        'title'       => 'Question Section',
        'object_types' => array('questions'),
        'fields'      => array(
            array(
                'id'   => 'fit-flw-qustn1',
                'name' => 'Follow Up question 1',
                'desc' => 'Write here the sub question',
                'type' => 'text',
            ),
            array(
                'id'   => 'fit-flw-check1',
                'name' => 'Follow Up 1 Answer',
                'desc' => 'Select items from the list',
                'type' => 'multicheck',
                'options' => array(
                    'f1_1' => 'jaa',
                    'f1_2' => 'nee',
                    'f1_3' => 'weit neit',
                    'f1_4' => 'geen idie',
                    'f1_5' => 'geen',
                ),
            ),
           
            array(
                'id'   => 'fit-flw-qustn2',
                'name' => 'Follow Up question 2',
                'desc' => 'Write here the sub question',
                'type' => 'text',
            ),
            array(
                'id'   => 'fit-flw-check2',
                'name' => 'Follow Up 2 Answer',
                'desc' => 'Select items from the list',
                'type' => 'multicheck',
                'options' => array(
                    'f2_5' => 'jaa',
                    'f2_6' => 'nee',
                    'f2_7' => 'man',
                    'f2_8' => 'vrouw',
                    'f2_9' => 'geen voorkeur',
                    'f2_11' => 'weit neit',
                    'f2_10' => 'geen',
                    
                ),
            ),
           
        ),
    );
    
    return $product_meta;
}

add_filter('cmb2_meta_boxes', 'metabox_fitnesspage');




/*

Output=========
<?php echo get_post_meta(get_the_ID(),'developer', true); ?>

*/

 