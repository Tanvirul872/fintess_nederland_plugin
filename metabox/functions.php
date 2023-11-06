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
                    'jaa' => 'jaa',
                    'nee' => 'nee',
                    'weit neit' => 'weit neit',
                    'geen idie' => 'geen idie',
                    'geen' => 'geen',
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
                    'jaa' => 'jaa',
                    'nee' => 'nee',
                    'man' => 'man',
                    'vrouw' => 'vrouw',
                    'geen voorkeur' => 'geen voorkeur',
                    'weit neit' => 'weit neit',
                    'geen' => 'geen', 
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

 