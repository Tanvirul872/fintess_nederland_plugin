<?php wp_head(); ?>

<section class="fitness_select_doc">  
<h2> Select doctors based on questions </h2>
<div class="accordion_fitness">
<div class="accordion">

<?php
// The Query
$args = array(
    'post_type' => 'questions', // Your custom post type
    'posts_per_page' => -1,     // To retrieve all posts 
    'order' => 'ASC', 
);

$the_query = new WP_Query($args);

// The Loop
if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {
        $the_query->the_post(); ?>

<?php 
    $followquestion1 = get_post_meta(get_the_ID(),'fit-flw-qustn1', true) ;
    $followCheck1 = get_post_meta(get_the_ID(), 'fit-flw-check1', true);
    $followquestion2 = get_post_meta(get_the_ID(),'fit-flw-qustn2', true) ;
    $followCheck2 = get_post_meta(get_the_ID(), 'fit-flw-check2', true);
    $total_row_of_qustn = count($followCheck1) * count($followCheck2) ;     
    // print_r($total_row_of_qustn) ; 
                    
?>


<!-- accodion items  -->

         <div class="accordion-item">
                    <div class="accordion-header">    <?php the_title(); ?>    </div>
                    <div class="accordion-content">
                        
                    <?php 
                    for ($i = 0; $i < $total_row_of_qustn; $i++) { ?> 
                            

                            <div class="question_sec">
                            <div class="select_doc">
                               <h2> <?php echo $i+1 ; ?> </h2> 
                               <input id="qustn_num" type="hidden" value="<?php echo get_the_ID().'_'.$i+1 ; ?>" >      
                            </div> 

                                <div class="select_doc">
                                    <label for="dropdown1"> Main Question : </label>
                                    <select id="dropdown1" width="10%">
                                        <option value="<?php echo get_the_ID(); ?>" selected><?php the_title(); ?></option>
                                    </select>       
                                </div>
                                
                                <div class="select_doc">
                                    <label for="dropdown2">Follow Up 1:</label>
                                    <select id="dropdown2" width="10%">
                                        <option value="option1" selected ><?php echo $followquestion1 ; ?></option>
                                    </select>
                                </div>

                                <div class="select_doc">
                                    <label for="followCheck1">Options 1:</label>
                                    <?php 
                                    
                                        if (!empty($followCheck1) && is_array($followCheck1)) {
                                            echo '<select id="followCheck1" width="10%">';
                                            foreach ($followCheck1 as $value => $label) {
                                                echo '<option value="' . esc_attr($label) . '">' . esc_html($label) . '</option>';
                                            }
                                            echo '</select>';
                                        }
                                    ?>

                                </div>

                                <div class="select_doc">
                                    <label for="dropdown4">Follow Up 2:</label>
                                    <select id="dropdown4">
                                        <option value="option1"><?php echo $followquestion1 ; ?></option>
                                    </select>
                                </div>

                                <div class="select_doc">
                                    <?php // print_r($followCheck2) ; ?>
                                    <label for="followCheck2">Options 2:</label>
                                    <?php 
                                        if (!empty($followCheck2) && is_array($followCheck2)) {
                                            echo '<select id="followCheck2" width="10%">';
                                            foreach ($followCheck2 as $value => $label) {
                                                echo '<option value="' . esc_attr($label) . '">' . esc_html($label) . '</option>';
                                            }
                                            echo '</select>';
                                        }
                                    ?>
                                </div>

                                <div class="select_doc">
                                <label for="dropdown6"> Select Doctor :</label> 
                                <?php
                                    $args = array(
                                        'post_type' => 'employees',
                                        'posts_per_page' => -1,
                                    );   

                                    $employee_query = new WP_Query($args);
                                    if ($employee_query->have_posts()) :
                                    ?>
                                    <select id="get_doctors">
                                        <?php
                                        while ($employee_query->have_posts()) :
                                            $employee_query->the_post();
                                        ?>
                                        <option value="<?php echo get_the_ID(); ?>" style="color:red"><?php the_title(); ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                    <?php
                                        wp_reset_postdata(); // Reset post data
                                        else :
                                            echo "No employees found.";
                                        endif;
                                    ?>

                                </div>
                                <div class="select_doc">
                                     <label for="dropdown6"></label> 
                                     <button class="btn btn-success save_questions" value="<?php echo get_the_ID().'_'.$i+1 ; ?>"> Save </button>
                                </div>


                            </div>
                    <?php } ?>

                </div>
        </div>
<!-- accodion items end  -->
 
        <?php }
} else {
   
    echo "No questions found.";
}

// Restore original post data
wp_reset_postdata();
?>



    </div>

</div>


</section>

<?php wp_footer(); ?>